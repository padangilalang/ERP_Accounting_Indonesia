<?php
$this->breadcrumbs=array(
		'P Products',
);

$this->menu=array(
		array('label'=>'Create pProduct','url'=>array('create')),
		array('label'=>'Manage pProduct','url'=>array('admin')),
);
?>

<h1>P Products</h1>

<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
