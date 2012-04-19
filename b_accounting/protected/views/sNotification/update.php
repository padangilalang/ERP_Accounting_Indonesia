<?php
$this->breadcrumbs=array(
		'Notification'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/preferences_desktop_notification.png') ?>
		Update:
		<?php echo $model->id; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>