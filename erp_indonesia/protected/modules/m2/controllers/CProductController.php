<?php

class CProductController extends Controller
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

	public function actionView($id)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new cProduct;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['cProduct']))
		{
			$model->attributes=$_POST['cProduct'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['cProduct']))
		{
			$model->attributes=$_POST['cProduct'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

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

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('cProduct');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	public function loadModel($id)
	{
		$model=cProduct::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='c-product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionCProductAutoComplete()
	{
		$res =array();
		if (isset($_GET['term'])) {
			//$qtxt ="SELECT CONCAT(item,' | ',id) as name FROM c_product WHERE item LIKE :name ORDER BY item LIMIT 20";
			$qtxt ="SELECT item as label, id FROM c_product WHERE item LIKE :name ORDER BY item LIMIT 20";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":name", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			//$res =$command->queryColumn();
			$res =$command->queryAll();


		}


		echo CJSON::encode($res);
		//echo print_r($_GET);
		//echo $test;
	}

}
