<?php

class GLeaveEssController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'rights',
		);
	}

	public function actionIndex()
	{
		$this->forward('person');
	}

	public function actionLeave($id=1)
	{
		$id=gPerson::model()->find('userid = '.Yii::app()->user->id)->id;
		$this->render('leave',array(
				'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPerson($id=1)
	{
		$id=gPerson::model()->find('userid = '.Yii::app()->user->id)->id;
		$this->render('person',array(
				'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new gLeave;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['gLeave']))
		{
			$model->attributes=$_POST['gLeave'];
			$model->parent_id=gPerson::model()->find('userid = '.Yii::app()->user->id)->id;  //default PETER
			$model->approved_id =1; ///request
			if($model->save())
				$this->redirect(array('leave'));
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['gPerson']))
		{
			$model->attributes=$_POST['gPerson'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=gPerson::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='g-person-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/////////////////////////////////////////////////////
	public function actionPrint($id,$pid)
	{
		$pdf=new leaveForm('P','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$model=gLeave::model()->findByPk((int)$id);
		$pdf->report($model);
			
		$pdf->Output();

	}

	public function actionSummary($pid)
	{
		$pdf=new leaveFormSum('P','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$criteria=new CDbCriteria;
		$criteria->with=array('leaveAll');
		//$criteria->together=true;
		$criteria->condition='leaveAll.approved_id = 2 or leaveAll.approved_id = 9';
		$criteria->compare('t.id',(int)$pid);
		$models=gPerson::model()->find($criteria);

		$pdf->report($models);
			
		$pdf->Output();

	}


}
