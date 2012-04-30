<?php
$this->breadcrumbs=array(
		'Notification',
);

$this->menu=array(
		array('label'=>'Create', 'url'=>array('create')),
);

$this->menu1=sNotification::getTopUpdated();
$this->menu2=sNotification::getTopCreated();


?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/preferences_desktop_notification.png') ?>
		Notification
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.BootTabbable', array(
		'type'=>'tabs', // 'tabs' or 'pills'
		'tabs' => array(
				array('label'=>'My Notification', 'content' =>$this->renderPartial("_tabMyNotification", array("dataProvider"=>$dataProviderMySelf), true),'active'=>true),
				array('label'=>'All Notification', 'content' =>$this->renderPartial("_tabAllNotification", array("dataProvider"=>$dataProvider), true),),
		),
));
?>
