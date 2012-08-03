<?php
$this->breadcrumbs=array(
		'Ssmsouts'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);$this->menu=array(
		array('label'=>'List SSmsout', 'url'=>array('index')),
		array('label'=>'Create SSmsout', 'url'=>array('create')),
		array('label'=>'View SSmsout', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage SSmsout', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		Update SSmsout
		<?php echo $model->id; ?>
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>