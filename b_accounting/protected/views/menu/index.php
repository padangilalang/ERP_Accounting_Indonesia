<?php /*
<?php $this->widget('bootstrap.widgets.BootThumbs', array(
    'dataProvider'=>$dataProviderImage,
    'template'=>"{items}\n{pager}",
    'itemView'=>'_thumb',
    // Remove the existing tooltips and rebind the plugin after each ajax-call.
    'afterAjaxUpdate'=>"js:function() {
        jQuery('.tooltip').remove();
        jQuery('a[rel=tooltip]').tooltip();
    }",
)); ?>
*/ ?>

<?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
        array('label'=>'Personal Notification', 'content'=>$this->renderPartial("_tabPersonal", array("model"=>$model,"dataProvider"=>$dataProvider),true),'active'=>true),
        array('label'=>'System Notification', 'content'=>$this->renderPartial("_tabSystem", array("model"=>$model3,"dataProvider"=>$dataProvider3), true)),
        array('label'=>'Chat', 'content'=>$this->renderPartial("_tabChat", array("model"=>$model), true),),
        array('label'=>'Admin ', 'content'=>$this->renderPartial("_tabAdmin", array("model"=>$model,"dataProvider"=>$dataProvider),true),'visible'=>Yii::app()->user->name=='admin'),
		array('label'=>'Create New', 'items'=>array(
            array('label'=>'Journal', 'content'=>'Test'),
            array('label'=>'@mdo', 'content'=>'Test2'),
        )),
	),
)); 

?>

<?php /*
<?php
$this->widget('message');
?>

<?php
$this->widget('message2');
?>

<?php
$this->widget('notificationsystem');
?>

<?php
$this->widget('notificationpersonal');
?>

*/ ?>

<?php 
//$this->renderPartial("_tabPersonal", array("model"=>$model,"dataProvider"=>$dataProvider), true);
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

