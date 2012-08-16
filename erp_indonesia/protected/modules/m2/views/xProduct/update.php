<?php
$this->breadcrumbs=array(
	'X Products'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List xProduct', 'url'=>array('index')),
	array('label'=>'Create xProduct', 'url'=>array('create')),
	array('label'=>'View xProduct', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage xProduct', 'url'=>array('admin')),
);
?>

<h1>Update xProduct <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>