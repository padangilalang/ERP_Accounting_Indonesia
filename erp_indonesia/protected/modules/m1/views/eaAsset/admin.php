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

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'eaAsset-category-grid',
		'dataProvider'=>eaAssetCategory::model()->mainsearch(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'class'=>'BootButtonColumn',
				),
				array(
						'name'=>'inventory_type',
						'type'=>'raw',
						'value'=>'CHtml::link($data->inventory_type,Yii::app()->createUrl("/m1/eaAsset/admin2",array("id"=>$data->id)))',
				),
				'remarks',
		),
)); ?>
<hr />
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'action'=>Yii::app()->createUrl($this->route),
		'type'=>'search',
		'method'=>'get',
		'htmlOptions'=>array('class'=>'well'),
)); ?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'item',array('class'=>'span3')); ?>
<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class'=>'btn', 'type'=>'submit')); ?>
<?php $this->endWidget(); ?>
<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
