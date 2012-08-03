<?php
$this->breadcrumbs=array(
		'eaAssets'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);$this->menu=array(
		array('label'=>'List eaAsset', 'url'=>array('index')),
		array('label'=>'Create eaAsset', 'url'=>array('create')),
		array('label'=>'View eaAsset', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage eaAsset', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		Update eaAsset
		<?php echo $model->id; ?>
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>