<?php
$this->breadcrumbs=array(
	'X Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List xProduct', 'url'=>array('index')),
	array('label'=>'Create xProduct', 'url'=>array('create')),
	array('label'=>'Update xProduct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete xProduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage xProduct', 'url'=>array('admin')),
);
?>

<h1>View xProduct #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'item_name',
		'photo_path',
		'created_date',
		'created_id',
		'updated_date',
		'updated_id',
	),
)); ?>
