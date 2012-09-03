<?php

class EmailComponent {

	public static function getInstance()
	{
		$classname=__CLASS__;
		return new $classname;
	}
	
	public function SendEmail($recipient,$subject,$body,$type="smtp",) {
		$mailer = Yii::createComponent('ext.mailer.EMailer');
		$mailer->IsSMTP();
		$mailer->IsHTML(true);
		$mailer->SMTPAuth = true;
		
		if ($type =="smtp") {
			$mailer->SMTPSecure = "ssl";
			$mailer->Host = "smtp.gmail.com";
			$mailer->Port = 465;
			$mailer->Username = "thony@folindonesia2013.com";
			$mailer->Password = 'thony2013';
			$mailer->From = "thony@folindonesia2013.com";
		} else {
			$mailer->Host = "smtp.mail.yahoo.co.id";
			$mailer->Port = 25;
			$mailer->Username = "festivaloflive2013";
			$mailer->Password = 'jmmindonesia';
			$mailer->From = "festivaloflive2013@yahoo.co.id";
		}
		
		$mailer->CharSet = 'UTF-8';
		//$mailer->addAttachment(Yii::app()->basePath."/reports/BuktiTerima.php");
		//$mailer->addAttachment(Yii::app()->basePath."/reports/bukti_".$id.".pdf");
		$mailer->FromName = Yii::app()->params['userEmail'];
		$mailer->AddAddress($recipient);
		$mailer->Subject = $subject;
		$mailer->Body = $body;
		$mailer->Send();				

	}

}

?>