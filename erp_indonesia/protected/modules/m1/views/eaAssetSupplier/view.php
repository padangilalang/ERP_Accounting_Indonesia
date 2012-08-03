<?php
$this->breadcrumbs=array(
		'Ea Asset Suppliers'=>array('index'),
		$model->id,
);$this->menu=array(
		array('label'=>'List eaAssetSupplier', 'url'=>array('index')),
		array('label'=>'Create eaAssetSupplier', 'url'=>array('create')),
		array('label'=>'Update eaAssetSupplier', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete eaAssetSupplier', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage eaAssetSupplier', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		View eaAssetSupplier #
		<?php echo $model->id; ?>
	</h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'supplier_name',
				'telpon',
				'fax',
				'remarks',
		),
)); ?>
