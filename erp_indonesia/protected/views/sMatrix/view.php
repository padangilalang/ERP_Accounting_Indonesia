<?php
$this->breadcrumbs=array(
		'Matrix'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/sMatrix')),
		array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/matrix.png') ?>
		<?php echo CHtml::encode($model->level); ?>
	</h1>
</div>

<?php 

$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'level',
				'level_r',
				'level_c',
				'level_u',
				'level_d',
		),
)); ?>
