<?php
$this->breadcrumbs=array(
		'G Cutis'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'List gLeave','url'=>array('index')),
		array('label'=>'Create gLeave','url'=>array('create')),
		array('label'=>'View gLeave','url'=>array('view','id'=>$model->id)),
		array('label'=>'Manage gLeave','url'=>array('admin')),
);
?>

<h1>
	Update gLeave
	<?php echo $model->id; ?>
</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>