<?php
$this->breadcrumbs=array(
		'Ssmsouts'=>array('index'),
		'Create',
);$this->menu=array(
		array('label'=>'List SSmsout', 'url'=>array('index')),
		array('label'=>'Manage SSmsout', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Create SSmsout</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>