<?php
$this->breadcrumbs=array(
		'G Families',
);

$this->menu=array(
		array('label'=>'Create gFamily','url'=>array('create')),
		array('label'=>'Manage gFamily','url'=>array('admin')),
);
?>

<h1>G Families</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
