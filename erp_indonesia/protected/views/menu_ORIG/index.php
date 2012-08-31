<?php /*
$this->beginWidget('application.extensions.messagecenter.EMessageCenter');
echo "";
$this->endWidget('application.extensions.messagecenter.EMessageCenter'); */
?>

<?php
$this->widget('bootstrap.widgets.BootTabbable', array(
		'type'=>'tabs', // 'tabs' or 'pills'
		'tabs' => array(
				array('label'=>'Personal Notification', 'icon'=>'tags','content' =>$this->renderPartial("_tabPersonal", array("model"=>$model,"dataProvider"=>$dataProvider), true),'active'=>true),
				array('label'=>'System Notification', 'icon'=>'tag', 'content' =>$this->renderPartial("_tabSystem", array("model"=>$model3,"dataProvider"=>$dataProvider3), true),),
				array('label'=>'Reminder', 'icon'=>'list-alt', 'content' =>$this->renderPartial("_tabReminder", array("model"=>$model,"modeltask"=>$modeltask), true),),
				array('label'=>'Chat', 'icon'=>'flag', 'content' =>$this->renderPartial("_tabChat", array("model"=>$model), true),),
				array('label'=>'Calendar', 'icon'=>'calendar', 'content' =>$this->renderPartial("_tabCalendar", array("model"=>$model), true),),
		),
));
?>

