<?php
$this->breadcrumbs=array(
		'Ea Asset Suppliers',
);$this->menu=array(
		array('label'=>'Create eaAssetSupplier', 'url'=>array('create')),
		array('label'=>'Manage eaAssetSupplier', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Ea Asset Suppliers</h1>
</div>
<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
