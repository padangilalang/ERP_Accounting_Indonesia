<?php
$this->breadcrumbs=array(
		'Ea Asset Categories'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);$this->menu=array(
		array('label'=>'List eaAssetCategory', 'url'=>array('index')),
		array('label'=>'Create eaAssetCategory', 'url'=>array('create')),
		array('label'=>'View eaAssetCategory', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage eaAssetCategory', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		Update eaAssetCategory
		<?php echo $model->id; ?>
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>