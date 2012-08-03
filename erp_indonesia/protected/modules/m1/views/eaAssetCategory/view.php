<?php
$this->breadcrumbs=array(
		'Ea Asset Categories'=>array('index'),
		$model->id,
);$this->menu=array(
		array('label'=>'List eaAssetCategory', 'url'=>array('index')),
		array('label'=>'Create eaAssetCategory', 'url'=>array('create')),
		array('label'=>'Update eaAssetCategory', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete eaAssetCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage eaAssetCategory', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		View eaAssetCategory #
		<?php echo $model->id; ?>
	</h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'parent_id',
				'inventory_type',
				'type1_info',
				'type2_info',
				'remarks',
		),
)); ?>
