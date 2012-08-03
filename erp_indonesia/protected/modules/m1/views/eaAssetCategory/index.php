<?php
$this->breadcrumbs=array(
		'Ea Asset Categories',
);$this->menu=array(
		array('label'=>'Create eaAssetCategory', 'url'=>array('create')),
		array('label'=>'Manage eaAssetCategory', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Ea Asset Categories</h1>
</div>
<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
