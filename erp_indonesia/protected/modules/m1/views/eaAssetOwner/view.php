<?php
$this->breadcrumbs=array(
		'Ea Asset Owners'=>array('index'),
		$model->id,
);$this->menu=array(
		array('label'=>'List eaAssetOwner', 'url'=>array('index')),
		array('label'=>'Create eaAssetOwner', 'url'=>array('create')),
		array('label'=>'Update eaAssetOwner', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete eaAssetOwner', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage eaAssetOwner', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		View eaAssetOwner #
		<?php echo $model->id; ?>
	</h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'parent_id',
				'owner',
				'remarks',
		),
)); ?>
