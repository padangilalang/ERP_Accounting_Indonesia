<?php

class MenuController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * Declares class-based actions.
	 */
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
				array('allow',  // allow all users to perform 'index' and 'view' actions
						//'actions'=>array('index'),
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}


	/**
	 * Lists all models.
	 */
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
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->refresh();
			}
		}

		return $model;
	}


	/**
	 * Action Version
	 */
	public function actionVersion()
	{
		$this->render('version');
	}

	/**
	 * Action About
	 */
	public function actionAbout()
	{
		$this->render('about');
	}

	/**
	 * Action No Module
	 */
	public function actionNamodule()
	{
		$this->render('namodule');
	}

	/**
	 * Displays the Help Pages
	 */
	public function actionHelp()   //OK BANGET tapi sayangnya masih Port 25
	{
		$model=new fEmail;

		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'www.matrainfotek.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'peter@matrainfotek.com';
		$mail->Password = '123456';

		if(isset($_POST['fEmail']))
		{
			$model->attributes=$_POST['fEmail'];
			if($model->validate())
			{
				$mail->SetFrom(Yii::app()->params['userEmail'], 'OTA Bethel');
				$mail->Subject = $model->subject;
				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
				$mail->MsgHTML($model->body);
				$mail->AddAddress(Yii::app()->params['adminEmail'], 'Peter J. Kambey');
				$mail->Send();

				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);


				Yii::app()->user->setFlash('contact','Your Email Has Been Send...');
				$this->refresh();
			}
		}
		$this->render('help',array('model'=>$model));
	}

	public function actionImage()
	{
		$model=new fImage;
		if(isset($_POST['fImage']))
		{
			$model->attributes=$_POST['fImage'];
			$model->image=CUploadedFile::getInstance($model,'image');
			//if($model->save())
			//{
			$model->image->saveAs('c:/wamp/www/myfile.jpg');

			$this->redirect(array('menu/'));
			//}
		}
		$this->render('image', array('model'=>$model));
	}


	public function actionViewTest() {

		// Render view and get content
		// Notice the last argument being `true` on render()
		$content = $this->render('help', array(
				'Test' => 'TestText 123',
		), true);

		// Plain text content
		$plainTextContent = "This is my Plain Text Content for those with cheap emailclients ;-)\nThis is my second row of text";

		// Get mailer
		$SM = Yii::app()->swiftMailer;

		// Get config
		$mailHost = 'www.matrainfotek.com';
		$mailPort = 25; // Optional
		//$username='peterjkambey@yahoo.co.id';
		//$password='';

		// New transport
		$Transport = $SM->smtpTransport($mailHost, $mailPort);

		// Mailer
		$Mailer = $SM->mailer($Transport);

		// New message
		$Message = $SM
		->newMessage('Testing')
		->setFrom(array('peter@matrainfotek.com' => 'Peter Matra'))
		->setTo(array('peterjkambey@gmail.com' => 'Peter Gmail'))
		->addPart($content, 'text/html')
		->setBody($plainTextContent);

		// Send mail
		$result = $Mailer->send($Message);

		$this->render('/menu1');

	}

}
