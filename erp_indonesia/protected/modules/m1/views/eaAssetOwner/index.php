<?php
$this->breadcrumbs=array(
		'Ea Asset Owners',
);$this->menu=array(
		array('label'=>'Create eaAssetOwner', 'url'=>array('create')),
		array('label'=>'Manage eaAssetOwner', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>Ea Asset Owners</h1>
</div>
<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
