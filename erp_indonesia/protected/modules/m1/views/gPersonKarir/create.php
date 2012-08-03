<?php
$this->breadcrumbs=array(
		'G Karirs'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'List gKarir','url'=>array('index')),
		array('label'=>'Manage gKarir','url'=>array('admin')),
);
?>

<h1>Create gKarir</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>