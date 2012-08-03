<?php

Yii::import('ext.EUserFlash');

class GAbsenceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column1', meaning
	 * using one-column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id,$month=0)
	{
		$absence=$this->newAbsence($id);

		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'modelAbsence'=>$absence,
				'month'=>$month,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id=null)
	{
		//Yii::import('application.extensions.alphapager.ApPagination');
			
		$criteria1=new CDbCriteria;
		//$alphaPages = new ApPagination('name');
		//$alphaPages->applyCondition($criteria1);

		$model=new gPerson();

		$criteria=new CDbCriteria;
		//$criteria->with=array('status','structure');
		//$criteria->compare('status.status_id',1);

		//if(isset($_GET['cPersonalia'])) {
		//	$model->attributes=$_GET['cPersonalia'];
		//	$criteria->compare('name',$model->name,true);
		//	$criteria->compare('id',$model->id);
		//}

		//if(isset($id)) {
		//	$criteria->compare('structure.structure_id',$id);
		//}

		//$criteria->order='updated_date DESC';
		//$criteria->mergeWith($criteria1,false);

		$dataProvider=new CActiveDataProvider('gPerson', array(
				'criteria'=>$criteria,
		));
			

		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
				//'alphaPages'=>$alphaPages, // Just like passing e.g. $pages to your view
		));

	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=cPersonalia::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cpersonalia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function newAbsence($id)
	{
		$model=new cPersonaliaAbsence;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['cPersonaliaAbsence']))
		{
			$model->attributes=$_POST['cPersonaliaAbsence'];
			$model->parent_id=cPersonalia::model()->findByPk((int)$id)->absensi_id;
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->refresh();
			}
		}

		return $model;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateAbsence($id,$pid)
	{
		$model=$this->loadModelAbsence($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['cPersonaliaAbsence']))
		{
			$model->attributes=$_POST['cPersonaliaAbsence'];
			if ($_POST['cPersonaliaAbsence']['remark']==null)
				$model->remark="Override By User";

			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');

				//----- begin new code --------------------
				if (!empty($_GET['asDialog']))
				{
					//Close the dialog, reset the iframe and update the grid
					echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
					Yii::app()->end();
				}
				else
					//----- end new code --------------------
					//EUserFlash::setSuccessMessage('This is a success message.');
					//EUserFlash::setAlertMessage('Hello world');
					$this->redirect(array('view','id'=>cPersonalia::model()->find(array("condition"=>"absensi_id = ".$pid))->id));
			}
		}

		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->render('updateAbsence',array(
				'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteAbsence($id)
	{
		$_mid=$this->loadModelAbsence($id)->parent_id;
		$this->loadModelAbsence($id)->delete();
		//$this->redirect(array('view','id'=>$_mid));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModelAbsence($id)
	{
		$model=cPersonaliaAbsence::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionProcess($id,$pid)
	{

		$model1=$this->loadModelAbsence($id);

		$diff = strtotime($model1->cdate) - strtotime(cPersonalia::model()->find(array('condition'=>'absensi_id = ' .$pid))->schedule_basedate);
		$days=round(abs($diff)/60/60/24);
		$pattern=cPersonalia::model()->find(array('condition'=>'absensi_id = ' .$pid))->pattern_id;
		$_parentid=cPersonalia::model()->find(array('condition'=>'absensi_id = ' .$pid))->id;
		$cycle=cSchedule::model()->findByPk($pattern)->daycycle;

		if ($days >= $cycle) {
			$daysc = $days % $cycle;
			$daysd = $daysc + 1;
		} else
			$daysd = $days + 1;
			
		$code=cScheduleDetail::model()->find(array('condition'=>'parent_id = ' .$pattern . ' AND ' .$daysd. ' BETWEEN day_start and day_end'))->code_id;

		$model1->realpattern_id = $code;
		$model1->save();
		Yii::app()->user->setFlash('success','Data berhasil disimpan');

		$this->redirect(array('/cAbsence/view','id'=>$_parentid));
	}

	////////////////////////////////////
	public function actionGenerate($pid)
	{
		$model=new fBeginEndDate;

		if (isset($_POST['fBeginEndDate']))
		{
			$model->attributes=$_POST['fBeginEndDate'];

			if($model->validate()) {

				$start = strtotime($model->begindate);
				$end = strtotime($model->enddate);
				$date = $start;
				while($date < $end)
				{

					//#1. Absence base on $pid and $begindate
					$_aid=cPersonalia::model()->find(array('condition'=>'id = ' .$pid))->absensi_id;
					$model1=cPersonaliaAbsence::model()->find(array('condition'=>'parent_id='.$_aid.' AND cdate = "'.date("Y-m-d",$date). '"'));

					if($model1===null) {   //Jika entry Data masih kosong

						$model1=new cPersonaliaAbsence;
						$model1->parent_id=$_aid;
						$model1->cdate=date("Y-m-d",$date);
						$model1->remark="Generated by System";
					}

					//METHOD 1. Read From CTimeBlock2###########################
					$model2=cTimeblock2::model()->find(array('condition'=>'absensi_id='.$_aid.' AND begin_date = "'.date("Ym",$date). '"'));

					if($model2 != null) {   //Method 1. Gunakan Method 1
						$_mdate="c". date("j",$date);
						$code=$model2->$_mdate;
							
					} else {

						$diff = $date - strtotime(cPersonalia::model()->findByPk((int)$pid)->schedule_basedate);
						$days=round(abs($diff)/60/60/24);
						$pattern=cPersonalia::model()->findByPk((int)$pid)->pattern_id;
						$cycle=cSchedule::model()->findByPk($pattern)->daycycle;
							
						if ($days >= $cycle) {
							$daysc = $days % $cycle;
							$daysd = $daysc + 1;
						} else
							$daysd = $days + 1;
							
						$code=cScheduleDetail::model()->find(array('condition'=>'parent_id = ' .$pattern . ' AND ' .$daysd. ' BETWEEN day_start and day_end'))->code_id;
					}

					$model1->realpattern_id = $code;
					$model1->save();
					Yii::app()->user->setFlash('success','Data berhasil disimpan');

					//write your code here
					$date = strtotime("+1 day", $date);

				}

				$this->redirect(array('/m1/cAbsence/view','id'=>$pid,'t'=>$date));
					


			}
		}

		$this->render('formAbsence1',array('model'=>$model));
	}

	public function actionSetSakit($id)
	{
		$modelUpdate=cPersonaliaAbsence::model()->updateByPk((int)$id,array('daystatus1_id'=>4));
			
	}

	public function actionSetAlpha($id)
	{
		$modelUpdate=cPersonaliaAbsence::model()->updateByPk((int)$id,array('daystatus1_id'=>10));
			
	}

	public function actionReport1()
	{
		$model=new fAbsence;

		if(isset($_POST['fAbsence']))
		{
			$model->attributes=$_POST['fAbsence'];
			if($model->validate()) {

				$pdf=new cAbsence1('L','mm','A4');
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->SetFont('Arial','',12);
					
				$pdf->report($model->project_id,$model->departemen_id,$model->begindate,$model->enddate);

				$pdf->Output();
					
			}
		}

		$this->render('report1',array('model'=>$model));
	}

	public function actionDynamicDept() {
		$cat_id = $_POST['fAbsence']['project_id'];
		$data=aOrganization::model()->findAll(array(
				'condition'=>'parent_id = '.$cat_id,
		));

		$data=CHtml::listData($data,'id','name');

		echo CHtml::tag('option', array('value'=>0),'(ALL)',true);

		foreach($data as $value=>$departemen_id)  {
			echo CHtml::tag('option',
					array('value'=>$value),CHtml::encode($departemen_id),true);
		}
	}

}
