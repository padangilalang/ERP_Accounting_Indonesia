<?php
$this->breadcrumbs=array(
		'Ea Asset Suppliers'=>array('index'),
		'Create',
);$this->menu=array(
		array('label'=>'List eaAssetSupplier', 'url'=>array('index')),
		array('label'=>'Manage eaAssetSupplier', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Create eaAssetSupplier</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>