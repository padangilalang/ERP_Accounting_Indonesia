<?php

class SAdminController extends Controller
{
	public $layout='//layouts/column1';

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
						'users'=>array('admin'),
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}
	public function actionSqlStatement()
	{
		$model=new fSqlStatement;

		if(isset($_POST['fSqlStatement']))
		{
			$model->attributes=$_POST['fSqlStatement'];
			if($model->validate())
			{
				$commandD=Yii::app()->db->createCommand($model->sql);
				$commandD->execute();

				Yii::app()->user->setFlash('success','SQL statement has been executed');
				$this->refresh();
			}
		}
		$this->render('sqlstatement',array('model'=>$model));
	}

	public function actionBackup()
	{

		Yii::import('SDatabaseDumper');
		$dumper = new SDatabaseDumper;
			
		// Get path to new backup file
		$file = Yii::getPathOfAlias('webroot.protected.backups').'/dump.'.Yii::app()->dateFormatter->format("yyyyMMdd",time()).'.sql';
			
		// Gzip dump
		if(function_exists('gzencode'))
			file_put_contents($file.'.gz', gzencode($dumper->getDump()));
		else
			file_put_contents($file, $dumper->getDump());
			
		Yii::app()->user->setFlash('success','<strong>Great!</strong> backup process finished..');
		$this->redirect(array('/menu'));

	}

	/////BLOCK TESTING


	public function actionSendEmail($id)
	{
		$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
		$mailer->IsSMTP();
		$mailer->IsHTML(true);
		$mailer->SMTPAuth = true;
		/*
		 $mailer->SMTPSecure = "ssl";
		$mailer->Host = "smtp.gmail.com";
		$mailer->Port = 465;
		$mailer->Username = "thony@folindonesia2013.com";
		$mailer->Password = 'thony2013';
		$mailer->From = "thony@folindonesia2013.com";
		*/
		/**/
		$mailer->Host = "smtp.mail.yahoo.co.id";
		$mailer->Port = 25;
		$mailer->Username = "festivaloflive2013";
		$mailer->Password = 'jmmindonesia';
		$mailer->From = "festivaloflive2013@yahoo.co.id";
		/**/
		$mailer->CharSet = 'UTF-8';
		$mailer->addAttachment(Yii::app()->basePath."/reports/BuktiTerima.php");
		//$mailer->addAttachment(Yii::app()->basePath."/reports/bukti_".$id.".pdf");
		$mailer->FromName = "Festival of Live 2013";
		$mailer->AddAddress("thonyronaldo.fol2013@gmail.com","peterjkambey@gmail.com");
		$mailer->Subject = "FOL Bukti Registrasi";
		$mailer->Body = "FOL Bukti Registrasi";
		$mailer->Send();

		$this->redirect(array('/peserta'));
	}


	public function actionCall1()
	{

		try {
			$api = new PhpSIP('202.153.128.34'); // IP we will bind to
			$api->setMethod('MESSAGE');
			$api->setFrom('sip:peterjkambey@voiprakyat.or.id');
			$api->setUri('sip:sicc1@voiprakyat.or.id');
			$api->setBody('Hi, ....');
			$res = $api->send();
			echo "res1: $res\n";

		} catch (Exception $e) {

			echo $e->getMessage()."\n";
		}

	}

	public function actionCall2()
	{
		try
		{
			$api = new PhpSIP(); // IP we will bind to
			$api->setUsername('118338'); // authentication username
			$api->setPassword('55XI8N'); // authentication password
			$api->setProxy('202.153.128.34');
			$api->addHeader('Event: resync');
			$api->setMethod('NOTIFY');
			$api->setFrom('sip:118338@voiprakyat.or.id');
			$api->setUri('sip:118339@voiprakyat.or.id');
			$res = $api->send();
			echo "res1: $res\n";

		} catch (Exception $e) {

			echo $e->getMessage()."\n";
		}
	}

	public function actionChatFB()
	{

		$obj = new FacebookChat("peterjkambey@yahoo.co.id", ".....");
		$obj->login();
		print_r($obj->buddylist());
		$obj->sendmsg("Hey jhonny, how are u?", "my_friend_id");
	}

	public function actionGraph1() {
		/*$bars = array(41,52,53,12,85,61,53,8,79,10,92,36);
		 $graph = new Chart();
		$graph->addBars($bars, 'ff0000');
		$graph->output();
		$graph->output('filename.png');*/

		$bars = array(5,5,5,1,8,6,5,8,7,1,2,3);
		$dates = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		$graph = new Chart();
		$graph->addBars($bars, 'ff0000');
		$graph->addXLabels($dates, '000000');
		$graph->addYScale('000000');
		$graph->output();
	}

	public function actionGraph2() {
		/* Create and populate the pData object */
		$MyData = new pData();
		$MyData->addPoints(array(13251,4118,3087,1460,1248,156,26,9,8),"Hits");
		$MyData->setAxisName(0,"Hits");
		$MyData->addPoints(array("Firefox","Chrome","Internet Explorer","Opera","Safari","Mozilla","SeaMonkey","Camino","Lunascape"),"Browsers");
		$MyData->setSerieDescription("Browsers","Browsers");
		$MyData->setAbscissa("Browsers");

		/* Create the pChart object */
		$myPicture = new pImage(500,500,$MyData);
		$myPicture->drawGradientArea(0,0,500,500,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		$myPicture->drawGradientArea(0,0,500,500,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
		$myPicture->setFontProperties(array("FontName"=>"../fonts/pf_arma_five.ttf","FontSize"=>6));

		/* Draw the chart scale */
		$myPicture->setGraphArea(100,30,480,480);
		$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10,"Pos"=>SCALE_POS_TOPBOTTOM)); //

		/* Turn on shadow computing */
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		/* Draw the chart */
		$myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30));

		/* Write the legend */
		$myPicture->drawLegend(570,215,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		/* Render the picture (choose the best way) */
		$myPicture->autoOutput("pictures/example.drawBarChart.vertical.png");

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

	public function actionBarcode()
	{
		$this->render('barcode');
	}

	public function actionHelp()   //OK BANGET tapi sayangnya masih Port 25
	{
		$model=new fEmail;
		
		if(isset($_POST['fEmail']))
		{
			$model->attributes=$_POST['fEmail'];
			if($model->validate())
			{

				EmailComponent::getInstance()->sendEmail('peterjkambey@gmail.com',$model->subject,$model->body,'ssl');

				Yii::app()->user->setFlash('success','<strong>Great!</strong> Your Message has been sent...');
				$this->redirect(array('/menu'));
			}
		}
		$this->render('help',array('model'=>$model));
	}



}
