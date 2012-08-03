<?php
$this->breadcrumbs=array(
		'Ea Asset Locations'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);$this->menu=array(
		array('label'=>'List eaAssetLocation', 'url'=>array('index')),
		array('label'=>'Create eaAssetLocation', 'url'=>array('create')),
		array('label'=>'View eaAssetLocation', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage eaAssetLocation', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		Update eaAssetLocation
		<?php echo $model->id; ?>
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>