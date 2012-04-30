<?php

class UJournalController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
				'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
				array('allow',
						//'users'=>array('@'),
						'users'=>sUser::getAccess('79'),
				),
				array('deny',
						'users'=>array('*'),
				),
		);
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

	public function actionUpdate($id)
	{
		$model=new fJournal;
		$modelHeader=uJournal::model()->findByPk((int)$id);

		if ($modelHeader->state_id == 3 or $modelHeader->state_id == 4) {
			Yii::app()->user->setFlash("error","<strong>Error!</strong> Journal cannot be edited. It has been posted/locked...");
			$this->redirect(array('/uJournal/view','id'=>$modelHeader->id));
		}

		//$this->performAjaxValidation($model);

		$_myDebit=0;
		$_myCredit=0;

		$model->balance="NOT OK";

		if(isset($_POST['account_no_id']))
		{
			$model->attributes=$_POST['fJournal'];

			$model->account_no_id=$_POST['account_no_id'];
			$model->debit=$_POST['debit'];
			$model->credit=$_POST['credit'];
			$model->user_remark=$_POST['user_remark'];


			foreach ($model->debit as $_debit)
				$_myDebit=$_myDebit+$_debit;

			foreach ($model->credit as $_credit)
				$_myCredit=$_myCredit+$_credit;

			if ($_myDebit == $_myCredit && $_myDebit != 0 && $_myCredit != 0)  {
				$model->balance="OK";
			} else
				$model->balance="NOT OK";

			if ($model->validate()) {
				$modelHeader->input_date=$_POST['fJournal']['input_date'];
				$modelHeader->yearmonth_periode=Yii::app()->settings->get("System", "cCurrentPeriod");
				$modelHeader->remark=$_POST['fJournal']['remark'];

				$modelHeader->save();

				$t=uJournalDetail::model()->deleteAll('parent_id = '.$id); //delete All Journal

				$_tdebet = 0;
				$_tcredit = 0;

				for($i = 0; $i < sizeof($model->account_no_id); ++$i):
				$modelDetail=new uJournalDetail;
				$modelDetail->parent_id=$modelHeader->id;
				$modelDetail->account_no_id=$model->account_no_id[$i];

				if ($model->debit[$i] != null) {
					$modelDetail->debit=$model->debit[$i];
				} else
					$modelDetail->debit=0;

				if ($model->credit[$i] != null) {
					$modelDetail->credit=$model->credit[$i];
				} else
					$modelDetail->credit=0;

				$modelDetail->user_remark=$model->user_remark[$i];

				$modelDetail->save();
				endfor;

				Yii::app()->user->setFlash("success","<strong>Great!</strong> Journal updated succesfully...");
				$this->redirect(array('/uJournal/view','id'=>$modelHeader->id));
				//$this->redirect(array('/uJournal'));

			}
		}

		if(!isset($_POST['account_no_id'])) {
			$model->input_date=$modelHeader->input_date;
			$model->yearmonth_periode=Yii::app()->settings->get("System", "cCurrentPeriod");
			$model->remark=$modelHeader->remark;
			$model->system_ref=$modelHeader->system_ref;
			$model->master_id=$modelHeader->id;

			$modelDetail = uJournalDetail::model()->findAll('parent_id ='.$modelHeader->id);

			foreach ($modelDetail as $mm) {
				$model->account_no_id[]=$mm->account_no_id;

				$model->debit[]=$mm->debit;

				$model->credit[]=$mm->credit;

				$model->user_remark[]=$mm->user_remark;
			}
		}

		$this->render('update',array('model'=>$model));
	}


	public function actionDelete($id)
	{
		$model=$this->loadModel($id);

		if ($model->state_id == 3 or $model->state_id == 4) {
			Yii::app()->user->setFlash("error","<strong>Error!</strong> Journal cannot be deleted. It has been posted/locked...");
			$this->redirect(array('/uJournal/view','id'=>$model->id));
		}

		$model->delete();

		Yii::app()->user->setFlash("success","Journal has been deleted succesfully... ");
		$this->redirect(array('/uJournal'));
	}

	public function actionIndex()
	{
		$model=new uJournal('search');
		$model->unsetAttributes();

		$criteria=new CDbCriteria;
		$criteria1=new CDbCriteria;

		$criteria->compare('module_id',1); //Journal Umum
		$criteria->order='t.yearmonth_periode DESC, t.created_date DESC';
		$criteria->compare('yearmonth_periode',Yii::app()->settings->get("System", "cCurrentPeriod"));

		if(isset($_GET['uJournal'])) {
			$model->attributes=$_GET['uJournal'];

			$criteria1->compare('system_ref',$_GET['uJournal']['system_ref'],true,'OR');
			$criteria1->compare('remark',$_GET['uJournal']['system_ref'],true,'OR');
		}

		$criteria->mergeWith($criteria1);

		$total = uJournal::model()->count($criteria);
		
		$pages = new CPagination($total);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);
		
		$dataProvider=uJournal::model()->findAll($criteria);
		

		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
				'pages' => $pages,
		));
	}

	public function loadModel($id)
	{
		$model=uJournal::model()->findByPk($id,array('condition'=>'module_id = 1'));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionJournalAutoComplete()
	{
		$res =array();
		if (isset($_GET['term'])) {
			$qtxt =
			"SELECT system_ref FROM u_journal WHERE module_id = 1 AND system_ref LIKE :name ORDER BY system_ref LIMIT 20";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":name", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			$res =$command->queryColumn();

		}
		echo CJSON::encode($res);
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='u-journal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionCreate()
	{
		$model=new fJournal;

		//$this->performAjaxValidation($model);

		//default value
		$_myDebit=0;
		$_myCredit=0;
		$model->balance="NOT OK";

		if(isset($_POST['account_no_id']))
		{
			$model->attributes=$_POST['fJournal'];

			$model->account_no_id=$_POST['account_no_id'];
			$model->debit=$_POST['debit'];
			$model->credit=$_POST['credit'];
			$model->user_remark=$_POST['user_remark'];


			foreach ($model->debit as $_debit)
				$_myDebit=$_myDebit+$_debit;

			foreach ($model->credit as $_credit)
				$_myCredit=$_myCredit+$_credit;

			if ($_myDebit == $_myCredit && $_myDebit != 0 && $_myCredit != 0)  {
				$model->balance="OK";
			} else
				$model->balance="NOT OK";

			if ($model->validate()) {
				$modelHeader=new uJournal;

				$modelHeader->input_date=$_POST['fJournal']['input_date'];
				$modelHeader->yearmonth_periode=Yii::app()->settings->get("System", "cCurrentPeriod");
				$modelHeader->remark=$_POST['fJournal']['remark'];

				$modelHeader->entity_id = 1;
				$modelHeader->module_id = 1; //GL
				$modelHeader->state_id = 1;
				$modelHeader->journal_type_id =1;

				$modelHeader->save();

				for($i = 0; $i < sizeof($model->account_no_id); ++$i):
				$modelDetail=new uJournalDetail;
				$modelDetail->parent_id=$modelHeader->id;
				$modelDetail->account_no_id=$model->account_no_id[$i];

				if ($model->debit[$i] != null) {
					$modelDetail->debit=$model->debit[$i];
				} else
					$modelDetail->debit=0;

				if ($model->credit[$i] != null) {
					$modelDetail->credit=$model->credit[$i];
				} else
					$modelDetail->credit=0;

				$modelDetail->user_remark=$model->user_remark[$i];

				$modelDetail->save();
				endfor;

				//Create System_ref
				$_ref ="GL-".$modelHeader->yearmonth_periode."-".str_pad($modelHeader->id,5,"0",STR_PAD_LEFT);
				$modelHeader->updateByPk((int)$modelHeader->id,array('system_ref'=>$_ref));

				Yii::app()->user->setFlash("success","<strong>Great!</strong> Journal created succesfully...");
				$this->redirect(array('/uJournal'));

			}
		}

		$this->render('create',array('model'=>$model));
	}

	public function actionPrint($id)
	{
		$pdf=new journalVoucher1('P','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$pdf->report($id);

		$pdf->Output();

	}

}
