<?php
$this->breadcrumbs=array(
		'eaAssets'=>array('index'),
		'Manage',
);$this->menu=array(
		array('label'=>'List eaAsset', 'url'=>array('index')),
		array('label'=>'Create eaAsset', 'url'=>array('create')),
);Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('eaAsset-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
<div class="page-header">
	<h1>Asset Management</h1>
</div>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<?php //$this->renderPartial('_search',array(
//'model'=>$model,
//)); ?>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'eaAsset-grid',
		'dataProvider'=>eaAsset::model()->search($id),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'class'=>'BootButtonColumn',
				),
				'input_date',
				array(
						'name'=>'category_id',
						'value'=>'eaAssetCategory::model()->findByPk($data->category_id)->inventory_type',
				),
				'periode_date',
				'item',
				'brand',
				'type',
				/*
				 'serial_number',
'inventory_code',
'bpb_number',
'po_number',
'amount',
'supplier_id',
'warranty',
'insurance',
'remark',
'photo_path',
'accesslevel_id',
*/
		),
));
?>