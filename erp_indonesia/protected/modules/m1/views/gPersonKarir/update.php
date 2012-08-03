<?php
$this->breadcrumbs=array(
		'G Karirs'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'List gKarir','url'=>array('index')),
		array('label'=>'Create gKarir','url'=>array('create')),
		array('label'=>'View gKarir','url'=>array('view','id'=>$model->id)),
		array('label'=>'Manage gKarir','url'=>array('admin')),
);
?>

<h1>
	Update gKarir
	<?php echo $model->id; ?>
</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>