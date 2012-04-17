<?php

class SReportController extends Controller
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

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionHelloWorld()
	{

		$pdf=new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'Hello World!');
		$pdf->Output();
	}

	public function actionMobile1()
	{
		require_once('hawhaw.php');
		$myPage = new HAW_deck("Welcome");
		$myText = new HAW_text("Hello WAP!");
		$myPage->add_text($myText);
		$myPage->create_page();
	}

	public function actionEmail1()   //not work
	{
		$message = new YiiMailMessage;
		$message->setBody('Message content here with HTML', 'text/html');
		$message->subject = 'My Subject';
		$message->addTo('peterjkambey@yahoo.co.id');
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}

	public function actionEmail2()   //OK BANGET tapi sayangnya masih Port 25
	{
		$model=new FEmail;

		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'smtp.mail.yahoo.co.id';
		$mail->SMTPAuth = true;
		$mail->Username = 'otabethel1@yahoo.co.id';
		$mail->Password = '....';

		if(isset($_POST['FEmail']))
		{
			$model->attributes=$_POST['FEmail'];
			if($model->validate())
			{
				$mail->SetFrom(Yii::app()->params['adminEmail'], 'Peter Kambey');
				$mail->Subject = $model->subject;
				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
				$mail->MsgHTML($model->body);
				$mail->AddAddress($model->email, 'No Name');
				$mail->Send();

				Yii::app()->user->setFlash('contact','Your Email Has Been Send...');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actionEmail3()  //integrate to actionEmail2
	{
		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'smtp.mail.yahoo.co.id';
		$mail->SMTPAuth = true;
		$mail->Username = 'otabethel1@yahoo.co.id';
		$mail->Password = '........';
		$mail->SetFrom('peterjkambey@yahoo.co.id', 'Peter Kambey');
		$mail->Subject = 'PHPMailer Test Subject via smtp, basic with authentication';
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->MsgHTML('<h1>JUST A TEST!</h1>');
		$mail->AddAddress('peterjkambey@gmail.com', 'Peter Kambey');
		$mail->Send();
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

}
