<?php
$this->breadcrumbs=array(
		'P Products'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'List pProduct','url'=>array('index')),
		array('label'=>'Manage pProduct','url'=>array('admin')),
);
?>

<h1>Create pProduct</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>