<?php /*
header('Content-Type: image/png');

$barcodeOptions = array('text' => 'ZEND-FRAMEWORK');
 
// No required options
$rendererOptions = array();
 
// Draw the barcode in a new image,
// send the headers and the image
Zend_Barcode::factory(
    'code39', 'image', $barcodeOptions, $rendererOptions
)->render();
*/
?>

<?php
// get my twitter status.///set Include Path on php.ini
/*
$client = new Zend_Http_Client('http://twitter.com/statuses/user_timeline/peterjkambey.xml', array(
    'maxredirects' => 0,
    'timeout'      => 30));
 
$response = $client->request();
 
if($response->isSuccessful())
    echo '<pre>' . htmlentities($response->getBody()) .'</pre>';
else
    echo $response->getRawBody();
*/
?>

<?php
$mail = new Zend_Mail();
$mail->setBodyText('This is the text of the mail.');
$mail->setFrom('peter@matrainfotek.com', 'Peter J. Kambey');
$mail->addTo('peterjkambey@gmail.com', 'Peter J. Kambey');
$mail->setSubject('TestSubject');
$mail->send();

?>	
