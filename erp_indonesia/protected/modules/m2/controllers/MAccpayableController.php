<?php

class MAccpayableController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
				'rights',
		);
	}

	public function actionView($id)
	{
		//$model=vPorder::model()->findByPk($id);

		$payment=$this->newPayment($id);

		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'modelPayment'=>$payment,
		));
	}

	public function actionViewRelated($id)
	{
		//$model=vPorder::model()->findByPk($id);

		$this->render('viewRelated',array(
				'model'=>$this->loadModel($id),
		));
	}

	public function actionIndex($id=1)
	{
		$this->render('index',array(
				'id'=>$id,
		));
	}

	public function actionJournalInventory()
	{
		if(isset($_POST['journal_id']))
		{
			$total=0;
			$m_ref=array();
			$m_ref2=array();

			foreach($_POST['journal_id'] as $a=>$val)
			{
				$model=vPorder::model()->findByPk((int)$val);
				if ($model->journal_state_id ==1) {
					$total=$total+$model->sum_po;
					$m_ref[]=$model->system_ref;
					$m_ref2[]=$model->system_ref.' ('.$model->sum_pof().')';
					vPorder::model()->updateByPk((int)$val,array('journal_state_id'=>2));
				}

				if ($total ==0) {
					Yii::app()->user->setFlash("error","<strong>Error!</strong> Selected PO already journalled...");
					$this->redirect(array('/m2/mAccpayable','id'=>2));
				}

			}

			$modelHeader=new uJournal;
			$modelHeader->input_date=Yii::app()->dateFormatter->format("dd-MM-yyyy",time());
			$modelHeader->yearmonth_periode=Yii::app()->settings->get("System", "cCurrentPeriod");
			$modelHeader->remark=implode($m_ref," ");
			$modelHeader->entity_id=sUser::model()->getGroup(); //default group
			$modelHeader->module_id=3; //AP
			$modelHeader->journal_type_id=1; //Purchasing
			$modelHeader->state_id=1;
			$modelHeader->created_by=Yii::app()->user->id;
			$modelHeader->created_date=time();

			$modelHeader->save();

			//Create System_ref
			$_ref ="PUR-".$modelHeader->yearmonth_periode."-".str_pad($modelHeader->id,5,"0",STR_PAD_LEFT);
			$modelHeader->updateByPk((int)$modelHeader->id,array('system_ref'=>$_ref));


			$modelDetail=new uJournalDetail;
			$modelDetail->parent_id=$modelHeader->id;
			$_inventory=tAccount::model()->with('inventory')->find('inventory.mvalue=1')->id;
			$modelDetail->account_no_id=$_inventory;

			$modelDetail->debit=$total;
			$modelDetail->credit=0;
			$modelDetail->user_remark=implode($m_ref2," ");
			$modelDetail->save();

			$modelDetail=new uJournalDetail;
			$modelDetail->parent_id=$modelHeader->id;
			$_hutang=tAccount::model()->with('hutang')->find('hutang.mvalue=1')->id;
			$modelDetail->account_no_id=$_hutang;
			$modelDetail->debit=0;
			$modelDetail->credit=$total;
			$modelDetail->user_remark=implode($m_ref2," ");
			$modelDetail->save();

			Yii::app()->user->setFlash("success","<strong>Great!</strong> Inventory Journal created succesfully...");

			$this->render('viewJournal',array(
					'model'=>$modelHeader,
			));


		} else
			$this->redirect(array('/m2/mAccpayable'));
	}

	public function actionJournalPayment()
	{

		if(isset($_POST['journal_id']))
		{
			$total=0;
			$m_ref=array();

			foreach($_POST['journal_id'] as $a=>$val)
			{
				$model=vPorder::model()->findByPk((int)$val);
				$total=$total+$model->sum_po;
				$m_ref[]=$model->system_ref;
				if ($model->journal_state_id ==3) {
					Yii::app()->user->setFlash("error","<strong>Error!</strong> This PO already journalled...");
					$this->redirect(array('/m2/mAccpayable','id'=>3));
				} else
					vPorder::model()->updateByPk((int)$val,array('journal_state_id'=>3));
			}

			$modelHeader=new uJournal;
			$modelHeader->input_date=Yii::app()->dateFormatter->format("dd-MM-yyyy",time());
			$modelHeader->yearmonth_periode=Yii::app()->settings->get("System", "cCurrentPeriod");
			$modelHeader->remark=implode($m_ref," ");
			$modelHeader->entity_id=sUser::model()->getGroup(); //default group
			$modelHeader->module_id=3; //AP
			$modelHeader->journal_type_id=2; //Payment
			$modelHeader->state_id=1;
			$modelHeader->created_by=Yii::app()->user->id;
			$modelHeader->created_date=time();

			$modelHeader->save();

			//Create System_ref
			$_ref ="AP-".$modelHeader->yearmonth_periode."-".str_pad($modelHeader->id,5,"0",STR_PAD_LEFT);
			$modelHeader->updateByPk((int)$modelHeader->id,array('system_ref'=>$_ref));


			$modelDetail=new uJournalDetail;
			$modelDetail->parent_id=$modelHeader->id;
			$_inventory=tAccount::model()->with('hutang')->find('hutang.mvalue=1')->id;
			$modelDetail->account_no_id=$_inventory;

			$modelDetail->debit=$total;
			$modelDetail->credit=0;
			$modelDetail->user_remark=implode($m_ref," ");
			$modelDetail->save();


			$modelPayment=vPorderPayment::model()->findAll('parent_id = '.$model->id);

			foreach ($modelPayment as $payment) {
				$modelDetail=new uJournalDetail;
				$modelDetail->parent_id=$modelHeader->id;
				$modelDetail->account_no_id=$payment->payment_source_id;
				$modelDetail->debit=0;
				$modelDetail->credit=$payment->amount;
				$modelDetail->user_remark=implode($m_ref," ");
				$modelDetail->save();
			}

			//in case ada selisih
			if ($payment->amount != $total) {
				$modelDetail=new uJournalDetail;
				$modelDetail->parent_id=$modelHeader->id;
				$_inventory=tAccount::model()->with('hutang')->find('hutang.mvalue=1')->id;
				$modelDetail->account_no_id=$_inventory;

				$modelDetail->debit=$payment->amount-$total;
				$modelDetail->credit=0;
				$modelDetail->user_remark='Correction: '.implode($m_ref," ");
				$modelDetail->save();
			}


			Yii::app()->user->setFlash("success","<strong>Great!</strong> Payment Journal created succesfully...");

			$this->render('viewJournal',array(
					'model'=>$modelHeader,
			));


		} else
			$this->redirect(array('/m2/mAccpayable'));
	}

	public function newPayment($id)
	{
		$model=new vPorderPayment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['vPorderPayment']))
		{
			$model->attributes=$_POST['vPorderPayment'];
			$model->parent_id=$id;
			if($model->save()) {
				//Create System_ref
				$_ref ="AP-".str_pad($model->id,5,"0",STR_PAD_LEFT);
				vPorderPayment::model()->updateByPk((int)$model->id,array('payment_ref'=>$_ref));

				$modelPO=$this->loadModel($id);

				if ($modelPO->payment >= $modelPO->sum_po)
					vPorder::model()->updateByPk((int)$modelPO->id,array('payment_state_id'=>2));

				$this->redirect(array('view','id'=>$id));
			}
		}

		return $model;
	}

	public function actionSetApproved($id)
	{
		$_date= Yii::app()->dateFormatter->format("yyyy-MM-dd",time());
		vPorder::model()->updateByPk((int)$id,array('approved_date'=>$_date));

	}

	public function loadModel($id)
	{
		$model=vPorder::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionViewSupplier($id)
	{
		$this->render('viewSupplier',array(
				'model'=>$this->loadModelSupplier($id),
		));
	}

	public function actionIndexSupplier()
	{
		$dataProvider=new CActiveDataProvider('cSupplier');

		$this->render('indexSupplier',array(
				'dataProvider'=>$dataProvider,
		));
	}

	public function loadModelSupplier($id)
	{
		$model=cSupplier::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionViewSupplierDetail($id)
	{
		$model=vPorder::model()->findByPk($id);

		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->render('viewSupplierDetail',array(
				'model'=>$model,
		));
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vPorder-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/////////////////////////////////////////////////////
	public function actionReport1($id)
	{
		$pdf=new pRequest1('L','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$pdf->pRequestR1($id);

		$pdf->Output();

	}

}
