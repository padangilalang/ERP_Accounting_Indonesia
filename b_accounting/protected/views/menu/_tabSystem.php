<?php		$this->renderPartial('_formNotification3', array('model'=>$model)); ?>

<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'/sNotification/_view3',
)); ?>

<br>

<?php
//$this->widget('sms');
//$this->widget('smssend');
//echo Yii::app()->getDateFormatter()->format('dd-MM-yyyy',time());
//echo Yii::app()->getLocale()->id;
//echo Yii::app()->getTimeZone();
//echo Yii::app()->getTheme()->name;

?>

<?php /*
$key = "IP";
$passage = urlencode("john 3:16");
$options = "include-passage-references=false";
$url = "http://www.esvapi.org/v2/rest/passageQuery?key=$key&passage=$passage&$options";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
print $response;
*/
?>
<hr />
<?php
/*
 $key = "IP";
$passage = urlencode("john 3:16");
$options = "include-passage-references=false&audio-format=flash";
$url = "http://www.esvapi.org/v2/rest/passageQuery?key=$key&passage=$passage&$options";
$data = fopen($url, "r") ;

if ($data)
{
while (!feof($data))
{
$buffer = fgets($data, 4096);
echo $buffer;
}
fclose($data);
}
else
{
die("fopen failed for url to webservice");
}
*/
?>