<?php
$this->breadcrumbs=array(
		'G Educations'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'List gEducation','url'=>array('index')),
		array('label'=>'Manage gEducation','url'=>array('admin')),
);
?>

<h1>Create gEducation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>