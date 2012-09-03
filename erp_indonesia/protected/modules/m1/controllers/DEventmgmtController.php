<?php

class dEventmgmtController extends Controller
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
				'rights',
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function newEvent()
	{
		$model=new dEventmgmt;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['dEventmgmt']))
		{
			$model->attributes=$_POST['dEventmgmt'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->redirect(array('index'));
			}
		}

		return $model;
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

		if(isset($_POST['dEventmgmt']))
		{
			$model->attributes=$_POST['dEventmgmt'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$event=$this->newEvent();

		$model=new dEventmgmt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['dEventmgmt']))
			$model->attributes=$_GET['dEventmgmt'];

		$this->render('admin',array(
				'model'=>$model,
				'modelevent'=>$event,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=dEventmgmt::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='deventmgmt-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
