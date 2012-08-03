<?php
$this->breadcrumbs=array(
		'Ea Asset Suppliers'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);$this->menu=array(
		array('label'=>'List eaAssetSupplier', 'url'=>array('index')),
		array('label'=>'Create eaAssetSupplier', 'url'=>array('create')),
		array('label'=>'View eaAssetSupplier', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage eaAssetSupplier', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		Update eaAssetSupplier
		<?php echo $model->id; ?>
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>