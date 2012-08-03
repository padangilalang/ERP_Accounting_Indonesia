<?php
$this->breadcrumbs=array(
		'Daddressbooks'=>array('index'),
		$model->title=>array('view','id'=>$model->id),
		'Update',
);$this->menu=array(
		array('label'=>'List DAddressbook', 'url'=>array('index')),
		array('label'=>'Create DAddressbook', 'url'=>array('create')),
		array('label'=>'View DAddressbook', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage DAddressbook', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		Update DAddressbook
		<?php echo $model->id; ?>
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>