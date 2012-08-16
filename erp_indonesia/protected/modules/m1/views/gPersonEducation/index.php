<?php
$this->breadcrumbs=array(
		'G Educations',
);

$this->menu=array(
		array('label'=>'Create gEducation','url'=>array('create')),
		array('label'=>'Manage gEducation','url'=>array('admin')),
);
?>

<h1>G Educations</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
