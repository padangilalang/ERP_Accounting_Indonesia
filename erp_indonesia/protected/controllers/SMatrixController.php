<?php

class SMatrixController extends Controller
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

	public function newMatrix()
	{
		$model=new sMatrix;

		// $this->performAjaxValidation($model);

		if(isset($_POST['sMatrix']))
		{
			$model->attributes=$_POST['sMatrix'];
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

		if(isset($_POST['sMatrix']))
		{
			$model->attributes=$_POST['sMatrix'];
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
		//$this->redirect(array('admin'));
	}

	public function actionIndex()
	{
		$matrix=$this->newMatrix();

		$model=new sMatrix('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['sMatrix']))
			$model->attributes=$_GET['sMatrix'];

		$this->render('index',array(
				'model'=>$model,
				'modelmatrix'=>$matrix,
		));
	}

	public function loadModel($id)
	{
		$model=sMatrix::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='module-matrix-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
