<?php

class SSmsinController extends Controller
{
	public $layout='//layouts/column1';

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

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// $this->performAjaxValidation($model);

		if(isset($_POST['sSmsin']))
		{
			$model->attributes=$_POST['sSmsin'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','SMS has been sent..');
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
		$dataProvider=new CActiveDataProvider('sSmsin');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	public function actionSendSMS()
	{

		$model=new fSms;

		if(isset($_POST['fSms']))
		{
			$model->attributes=$_POST['fSms'];
			if($model->validate())

				$myfile = date("Ymd-His").".txt";
			$fh = fopen("C:\\wamp\\www\\yii\\playsms\\outgoing\\".$myfile, "w")
			or die("can't open file");
			$stringData = "To: " .$model->hp ."\n";
			fwrite($fh, $stringData);
			$stringData = "\n";
			fwrite($fh, $stringData);
			$stringData = $model->message;
			fwrite($fh, $stringData);
			fclose($fh);

			$this->redirect(Yii::app()->user->returnUrl);
		}

		$this->render('sendsms',array(
				'model'=>$model,
		));


	}

	public function actionAdmin()
	{
		$model=new sSmsin('search');
		$model->unsetAttributes();
		if(isset($_GET['sSmsin']))
			$model->attributes=$_GET['sSmsin'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=sSmsin::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sSmsin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
