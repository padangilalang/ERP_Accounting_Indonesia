<?php
$this->breadcrumbs=array(
		'Ea Asset Locations'=>array('index'),
		$model->id,
);$this->menu=array(
		array('label'=>'List eaAssetLocation', 'url'=>array('index')),
		array('label'=>'Create eaAssetLocation', 'url'=>array('create')),
		array('label'=>'Update eaAssetLocation', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete eaAssetLocation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage eaAssetLocation', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		View eaAssetLocation #
		<?php echo $model->id; ?>
	</h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'parent_id',
				'location',
				'remarks',
		),
)); ?>
