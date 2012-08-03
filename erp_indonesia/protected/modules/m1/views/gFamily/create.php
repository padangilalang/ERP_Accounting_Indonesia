<?php
$this->breadcrumbs=array(
		'G Families'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'List gFamily','url'=>array('index')),
		array('label'=>'Manage gFamily','url'=>array('admin')),
);
?>

<h1>Create gFamily</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>