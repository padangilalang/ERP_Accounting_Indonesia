<?php
$this->breadcrumbs=array(
		'Ea Asset Categories'=>array('index'),
		'Create',
);$this->menu=array(
		array('label'=>'List eaAssetCategory', 'url'=>array('index')),
		array('label'=>'Manage eaAssetCategory', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Create eaAssetCategory</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>