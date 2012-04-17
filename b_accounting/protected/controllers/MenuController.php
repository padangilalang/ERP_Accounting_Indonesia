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

	public function actionHelp()   //OK BANGET tapi sayangnya masih Port 25
	{
		$model=new FEmail;

		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'smtp.mail.yahoo.co.id';
		$mail->SMTPAuth = true;
		$mail->Username = 'otabethel@yahoo.co.id';
		$mail->Password = 'Gb1Otab';

		if(isset($_POST['FEmail']))
		{
			$model->attributes=$_POST['FEmail'];
			if($model->validate())
			{
				$mail->SetFrom(Yii::app()->params['userEmail'], 'OTA Bethel');
				$mail->Subject = $model->subject;
				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
				$mail->MsgHTML($model->body);
				$mail->AddAddress(Yii::app()->params['adminEmail'], 'Peter J. Kambey');
				$mail->Send();

				Yii::app()->user->setFlash('contact','Your Email Has Been Send...');
				$this->refresh();
			}
		}
		$this->render('help',array('model'=>$model));
	}

	public function actionImage()
	{
		$model=new FImage;
		if(isset($_POST['FImage']))
		{
			$model->attributes=$_POST['FImage'];
			$model->image=CUploadedFile::getInstance($model,'image');
			//if($model->save())
			//{
			$model->image->saveAs('c:/wamp/www/myfile.jpg');

			$this->redirect(array('menu/'));
			//}
		}
		$this->render('image', array('model'=>$model));
	}

	public function actionPeter()
	{
		$this->render('peter');
	}

	public function actionFileBrowser()
	{
		$root = 'c:/';

		$_POST['dir'] = urldecode($_POST['dir']);

		if( file_exists($root . $_POST['dir']) ) {
			$files = scandir($root . $_POST['dir']);
			natcasesort($files);
			if( count($files) > 2 ) { /* The 2 accounts for . and .. */
				echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
				// All dirs
				foreach( $files as $file ) {
					if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file) ) {
						echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
					}
				}
				// All files
				foreach( $files as $file ) {
					if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($root . $_POST['dir'] . $file) ) {
						$ext = preg_replace('/^.*\./', '', $file);
						echo "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";
					}
				}
				echo "</ul>";
			}
		}
	}

}
