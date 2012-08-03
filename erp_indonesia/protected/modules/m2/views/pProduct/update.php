<?php
$this->breadcrumbs=array(
		'P Products'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'List pProduct','url'=>array('index')),
		array('label'=>'Create pProduct','url'=>array('create')),
		array('label'=>'View pProduct','url'=>array('view','id'=>$model->id)),
		array('label'=>'Manage pProduct','url'=>array('admin')),
);
?>

<h1>
	Update pProduct
	<?php echo $model->id; ?>
</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>