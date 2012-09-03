<?php

class MenuController extends Controller
{
	public $layout='//layouts/main';

	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
		);
	}

	public function filters()
	{
		return array(
				'rights',
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

		$modeltask=$this->newTask();


		if(!Yii::app()->user->isGuest) {
			$dataProvider=sNotification::model()->searchFilter();
			$dataProvider3=sNotification3::model()->searchFilter3();


			$this->render('index',array(
					'dataProvider'=>$dataProvider,
					'model'=>$model,
					'dataProvider3'=>$dataProvider3,
					'model3'=>$model3,
					'modeltask'=>$modeltask,
			));

		} else {
			$this->redirect(array('site/login'));
		}

	}

	public function newNotification()
	{
		$model=new sNotification;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sNotification']))
		{
			$model->attributes=$_POST['sNotification'];
			$model->sender_id=Yii::app()->user->id;
			$model->type_id=2;
			$model->read_id=1;
			$model->category_id=12;
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->refresh();
			}
		}

		return $model;

	}

	public function newNotification3()   //type_id = 3 ; Custom Message. category_id = 50 ; Custom Message
	{
		$model=new sNotification3;

		// Uncomment the following line if AJAX validation is needed
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function newTask()
	{
		$model=new sTask;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sTask']))
		{
			$model->attributes=$_POST['sTask'];
			$model->created_by=Yii::app()->user->id;
			$model->mark_id=1;
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->refresh();
			}
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
