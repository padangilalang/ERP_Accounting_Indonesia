<?php

class SModuleController extends Controller
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
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	public function newModule()
	{
		$model=new sModule;

		// $this->performAjaxValidation($model);

		if(isset($_POST['sModule']))
		{
			$model->attributes=$_POST['sModule'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','<strong>Great!</strong> data has been saved successfully');
				$this->redirect(array('index'));
			}
		}

		return $model;
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// $this->performAjaxValidation($model);

		if(isset($_POST['sModule']))
		{
			$model->attributes=$_POST['sModule'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','<strong>Great!</strong> data has been saved successfully');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(array('admin'));
	}

	public function actionIndex()
	{
		$module=$this->newModule();

		$model=new sModule('search');
		$model->unsetAttributes();
		if(isset($_GET['sModule']))
			$model->attributes=$_GET['sModule'];

		$this->render('index',array(
				'model'=>$model,
				'modelmodule'=>$module,
		));
	}

	public function loadModel($id)
	{
		$model=sModule::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='module-module-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
