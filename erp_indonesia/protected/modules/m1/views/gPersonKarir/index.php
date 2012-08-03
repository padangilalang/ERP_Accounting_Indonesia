<?php
$this->breadcrumbs=array(
		'G Karirs',
);

$this->menu=array(
		array('label'=>'Create gKarir','url'=>array('create')),
		array('label'=>'Manage gKarir','url'=>array('admin')),
);
?>

<h1>G Karirs</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
