<?php
$this->breadcrumbs=array(
	'X Products',
);

$this->menu=array(
	array('label'=>'Create xProduct', 'url'=>array('create')),
	array('label'=>'Manage xProduct', 'url'=>array('admin')),
);
?>

<h1>X Products</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
