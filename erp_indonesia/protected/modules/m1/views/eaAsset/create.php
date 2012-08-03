<?php
$this->breadcrumbs=array(
		'eaAssets'=>array('index'),
		'Create',
);$this->menu=array(
		array('label'=>'List eaAsset', 'url'=>array('index')),
		array('label'=>'Manage eaAsset', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Create eaAsset</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>