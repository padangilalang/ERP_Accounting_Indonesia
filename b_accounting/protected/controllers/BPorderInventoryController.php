<?php

class BPorderInventoryController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
				array('allow',
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}

	public function actionTest()
	{
		$this->render('test');
	}

	public function actionView($id)
	{
		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewDetail($id)
	{
		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->render('viewDetail',array(
				'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate() //PO Inventory
	{
		$model=new bPorder;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['bPorder']))
		{

			$model->attributes=$_POST['bPorder'];
			

			if($model->validate()) {

				echo print_r($_POST);
				die;
				
				$model->organization_id=sUser::model()->getGroup() ; //default user Group
				$model->periode_date=Yii::app()->settings->get("System", "cCurrentPeriod");
				$model->payment_state_id=1;
				$model->journal_state_id=1;
				$model->budgetcomp_id=0;
				$model->po_type_id=1; //PO Inventory

				$model->save();

				//Detail...
				//$model->item_id=$_POST['item_id'];
				//$model->description=$_POST['description'];
				//$model->qty=$_POST['qty'];
				//$model->amount=$_POST['amount'];

				for($i = 0; $i < sizeof($modelD->item_id); ++$i):
					$modelDetail=new bPorderDetail;
					$modelDetail->parent_id=$model->id;
					$modelDetail->item_id=$modelD->item_id[$i];
					$modelDetail->description=$modelD->description[$i];
					($modelD->qty[$i] != null) ? $modelDetail->qty=$modelD->qty[$i] : $modelDetail->qty=1;
					($modelD->amount[$i] != null) ? $modelDetail->amount=$modelD->amount[$i] : $modelDetail->amount=0;

					$modelDetail->save();
				endfor;

				//Create System_ref
				$_ref ="PO-".$model->periode_date."-".str_pad($model->id,5,"0",STR_PAD_LEFT);
				$model->updateByPk((int)$model->id,array('system_ref'=>$_ref));

				Yii::app()->user->setFlash("success","<strong>Great!</strong> PO created succesfully...");
				$this->redirect(array('/bPorderInventory'));
			}
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if ($model->approved_date !=null) {
			Yii::app()->user->setFlash("error","<strong>Error!</strong> PO already approved. Can't be edited...");
			$this->redirect(array('/bPorderInventory'));
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['bPorderInventory']))
		{
			$model->attributes=$_POST['bPorderInventory'];

			if($model->validate()) {

				$modelHeader=$this->loadModel($id);
				$modelHeader->input_date=$model->input_date;
				$modelHeader->system_ref=$model->system_ref;
				$modelHeader->periode_date=$model->periode_date;
				$modelHeader->budgetcomp_id=$model->budgetcomp_id;
				$modelHeader->remark=$model->remark;
				$modelHeader->issuer_id=$model->issuer_id;
				$modelHeader->organization_id=sUser::model()->getGroup() ; //default user Group
				$modelHeader->payment_state_id=1;
				$modelHeader->save();

				//Detail...
				$model->item_id=$_POST['item_id'];
				$model->department_id=$_POST['department_id'];
				$model->description=$_POST['description'];
				//$model->user=$_POST['user'];
				//$model->qty=$_POST['qty'];
				$model->amount=$_POST['amount'];

				$t=bPorderDetail::model()->deleteAll(array('condition'=>'parent_id = '.(int)$id));

				for($i = 0; $i < sizeof($model->item_id); ++$i):
				$modelDetail=new bPorderDetail;
				$modelDetail->parent_id=$modelHeader->id;
				$modelDetail->item_id=$model->item_id[$i];
				$modelDetail->department_id=$model->department_id[$i];
				$modelDetail->description=$model->description[$i];
				//$modelDetail->user=$model->user[$i];
				//($model->qty[$i] != null) ? $modelDetail->qty=$model->qty[$i] : $modelDetail->qty=1;
				$modelDetail->qty=1;
				($model->amount[$i] != null) ? $modelDetail->amount=$model->amount[$i] : $modelDetail->amount=0;

				$modelDetail->save();
				endfor;


				$this->redirect(array('/bPorderInventory'));

			}
		}

		$modelDetail = bPorderDetail::model()->findAll(array('condition'=>'parent_id ='.$model->id,'order'=>'id'));

		//foreach ($modelDetail as $mm) {

		//	$model->item_id[]=$mm->item_id;
		//	$model->description[]=$mm->description;
		//	$model->qty[]=$mm->qty;
		//	$model->amount[]=$mm->amount;
		//}

		$this->render('update',array(
				'model'=>$model,
				'modelD'=>$modelDetail,
		));
	}

	public function actionDelete($id)
	{

		$model=$this->loadModel($id);

		if ($model->approved_date !=null) {
			Yii::app()->user->setFlash("error","<strong>Error!</strong> PO already approved. Can't be deleted...");
			$this->redirect(array('/bPorderInventory'));
		}

		$model->delete();
	}

	public function actionIndex($id=1)
	{
		$this->render('index',array(
				'id'=>$id,
		));
	}


	public function loadModel($id)
	{
		$model=bPorder::model()->findByPk($id,'po_type_id = 1');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bPorderInventory-form')
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

	public function actionDynamicItems()
	{
		$data=pProduct::model()->findAll();

		$data=CHtml::listData($data,'id','no_polisi');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value'=>$value),CHtml::encode($name),true);
		}

	}

	public function actionGrid()
	{
		$this->render('grid',array(
		));
	}
}
