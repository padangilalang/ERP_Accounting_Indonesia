<?php
$this->breadcrumbs=array(
	'X Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List xProduct', 'url'=>array('index')),
	array('label'=>'Manage xProduct', 'url'=>array('admin')),
);
?>

<h1>Create xProduct</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>