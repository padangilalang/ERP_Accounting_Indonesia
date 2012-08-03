<?php
$this->breadcrumbs=array(
		'Parameter'=>array('index'),
		$model->name=>array('view','id'=>$model->type),
		'Update',
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/ms_dos_batch_file.png') ?>
		<?php echo $model->name; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_formNoType', array('model'=>$model)); ?>