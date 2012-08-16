<?php
$this->breadcrumbs=array(
		'G Families'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'List gFamily','url'=>array('index')),
		array('label'=>'Create gFamily','url'=>array('create')),
		array('label'=>'View gFamily','url'=>array('view','id'=>$model->id)),
		array('label'=>'Manage gFamily','url'=>array('admin')),
);
?>

<h1>
	Update gFamily
	<?php echo $model->id; ?>
</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>