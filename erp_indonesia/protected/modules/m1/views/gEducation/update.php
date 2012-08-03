<?php
$this->breadcrumbs=array(
		'G Educations'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'List gEducation','url'=>array('index')),
		array('label'=>'Create gEducation','url'=>array('create')),
		array('label'=>'View gEducation','url'=>array('view','id'=>$model->id)),
		array('label'=>'Manage gEducation','url'=>array('admin')),
);
?>

<h1>
	Update gEducation
	<?php echo $model->id; ?>
</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>