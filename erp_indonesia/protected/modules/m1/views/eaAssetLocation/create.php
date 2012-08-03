<?php
$this->breadcrumbs=array(
		'Ea Asset Locations'=>array('index'),
		'Create',
);$this->menu=array(
		array('label'=>'List eaAssetLocation', 'url'=>array('index')),
		array('label'=>'Manage eaAssetLocation', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Create eaAssetLocation</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>