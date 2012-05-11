<?php

class MenuController extends Controller
{
	public $layout='//layouts/main';

	public function actions()
	{
		return array(
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
		);
	}

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
						'users'=>array('@'),
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}


	public function actionIndex()
	{
		/*
		 1 = Admin Message
		2 = User Message
		3 = Allocation Custom Message

		*/

		$model=$this->newNotification();
		$model3=$this->newNotification3();


		if(!Yii::app()->user->isGuest) {
			$dataProvider=sNotification::model()->searchFilter();
			$dataProvider3=sNotification3::model()->searchFilter3();
			$dataProviderImage=sModule::model()->searchMenuImage();

			//Yii::app()->user->setFlash('success','<strong>Testing Flash</strong>..Testing Flash... Bagus nggak nih flash...');

			$this->render('index',array(
					'dataProvider'=>$dataProvider,
					'model'=>$model,
					'dataProvider3'=>$dataProvider3,
					'model3'=>$model3,
					'dataProviderImage'=>$dataProviderImage,
			));

		} else {
			$this->redirect(array('site/login'));
		}

	}

	public function newNotification()
	{
		$model=new sNotification;

		// $this->performAjaxValidation($model);

		if(isset($_POST['sNotification']))
		{
			$model->attributes=$_POST['sNotification'];
			$model->sender_id=Yii::app()->user->id;
			$model->type_id=2;
			$model->read_id=1;
			$model->category_id=12;
			if($model->save()) {
				Yii::app()->user->setFlash('success','Message has been sent...');
				$this->refresh();
			}
		}

		return $model;

	}

	public function newNotification3()   //type_id = 3 ; Custom Message. category_id = 50 ; Custom Message
	{
		$model=new sNotification3;

		// $this->performAjaxValidation($model);

		if(isset($_POST['sNotification3']))
		{
			$model->attributes=$_POST['sNotification3'];
			$model->sender_id=Yii::app()->user->id;
			$model->type_id=3;
			$model->read_id=1;
			$model->receiver_id=1;
			//$model->category_id=50;
			if($model->save())
				$this->refresh();
		}

		return $model;

	}

	public function actionVersion()
	{
		$this->render('version');
	}

	public function actionAbout()
	{
		$this->render('about');
	}

	public function actionNamodule()
	{
		$this->render('namodule');
	}

}
