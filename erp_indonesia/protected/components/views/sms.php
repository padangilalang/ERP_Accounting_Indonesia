<?php
$max=0;

foreach (glob("C:/cygwin/var/spool/sms/incoming/*.*") as $filename) {
	//$max++;
	//if ($max == 11)
	//	break;

	$model=SSmsin::model()->findBySql('select filename from s_smsin where filename ="'.$filename .'"');
	if($model===null) {
		$command=Yii::app()->db->createCommand(
				'INSERT INTO s_smsin (filename, cfrom, sent, received, modem, message) VALUES (:filename, :from , :sent , :received , :modem , :message );');


		$handle   = fopen($filename, 'r');
		$data     = fread($handle, filesize($filename));
		$rowsArr  = explode("\n",$data);

		$message="";
		$sms=array();
		$lastline=count($rowsArr);
		for($i=0;$i<count($rowsArr);$i++) {
			$lineDetails = explode(' ', $rowsArr[$i]);
			if ($lineDetails[0] == 'From:') {
				$from = $lineDetails[1];
				$command->bindParam(":from",$from,PDO::PARAM_STR);
			}
			if ($lineDetails[0] == 'Sent:') {
				$sent = $lineDetails[1] ." ".$lineDetails[2];
				$command->bindParam(":sent",$sent,PDO::PARAM_STR);
			}
			if ($lineDetails[0] == 'Received:') {
				$received = $lineDetails[1] ." ".$lineDetails[2];
				$command->bindParam(":received",$received,PDO::PARAM_STR);
			}
			if ($lineDetails[0] == 'Modem:') {
				$modem = $lineDetails[1];
				$command->bindParam(":modem",$modem,PDO::PARAM_STR);
			}
			if ($lineDetails[0] == 'Length:') {
				$i=$i+2;
				for($i=$i;$i<count($rowsArr);$i++) {
					$message = $message . " " .$rowsArr[$i];
					$command->bindParam(":message",$message,PDO::PARAM_STR);
				}
			}

		}

		$command->bindParam(":filename",$filename,PDO::PARAM_STR);
		$command->execute();
	}
	//echo "SUKSES";
}
?>

