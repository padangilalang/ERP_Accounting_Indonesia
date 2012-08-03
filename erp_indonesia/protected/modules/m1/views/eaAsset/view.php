<?php
$this->breadcrumbs=array(
		'eaAssets'=>array('index'),
		$model->id,
);$this->menu=array(
		array('label'=>'List eaAsset', 'url'=>array('index')),
		array('label'=>'Create eaAsset', 'url'=>array('create')),
		array('label'=>'Update eaAsset', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete eaAsset', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage eaAsset', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		View eaAsset #
		<?php echo $model->id; ?>
	</h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'input_date',
				'periode_date',
				'item',
				'brand',
				'type',
				'serial_number',
				'category_id',
				'inventory_code',
				'bpb_number',
				'po_number',
				//'amount',
				'supplier_id',
				'warranty',
				'insurance',
				'remark',
				'photo_path',
				'accesslevel_id',
				'created_date',
				'created_by',
				'updated_date',
				'updated_by',
		),
)); ?>
