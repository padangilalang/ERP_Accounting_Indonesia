<?php
$this->breadcrumbs=array(
		'Ea Asset Locations',
);$this->menu=array(
		array('label'=>'Create eaAssetLocation', 'url'=>array('create')),
		array('label'=>'Manage eaAssetLocation', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Ea Asset Locations</h1>
</div>
<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
