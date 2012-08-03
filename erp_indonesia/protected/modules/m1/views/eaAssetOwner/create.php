<?php
$this->breadcrumbs=array(
		'Ea Asset Owners'=>array('index'),
		'Create',
);$this->menu=array(
		array('label'=>'List eaAssetOwner', 'url'=>array('index')),
		array('label'=>'Manage eaAssetOwner', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Create eaAssetOwner</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>