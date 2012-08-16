<?php
$this->breadcrumbs=array(
		'Matrix'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'Create', 'url'=>array('create')),
);
?>

<div class="page-header">
	<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/matrix.png') ?>
	Data Matrix</h1>
</div>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'module-matrix-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'class'=>'BootButtonColumn',
				),
				'level',
				'level_r',
				'level_c',
				'level_u',
				'level_d',
		),
)); ?>

<hr>

<?php echo $this->renderPartial('_form', array('model'=>$modelmatrix)); ?>
