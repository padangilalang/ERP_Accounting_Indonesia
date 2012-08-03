<?php
$this->breadcrumbs=array(
		'Notification'=>array('index'),
		'Create',
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/preferences_desktop_notification.png') ?>
		Create
	</h1>
</div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>