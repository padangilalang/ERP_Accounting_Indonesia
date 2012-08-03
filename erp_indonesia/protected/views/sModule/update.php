<?php
$this->breadcrumbs=array(
		'Module'=>array('index'),
		$model->name=>array('view','id'=>$model->id),
		'Update',
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/blockdevice.png') ?>
		<?php echo $model->title; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>