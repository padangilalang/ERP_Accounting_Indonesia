<?php
$this->breadcrumbs=array(
		'Ea Asset Owners'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);$this->menu=array(
		array('label'=>'List eaAssetOwner', 'url'=>array('index')),
		array('label'=>'Create eaAssetOwner', 'url'=>array('create')),
		array('label'=>'View eaAssetOwner', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage eaAssetOwner', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		Update eaAssetOwner
		<?php echo $model->id; ?>
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>