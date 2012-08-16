<?php
$this->breadcrumbs=array(
		'Ea Asset Owners'=>array('index'),
		'Manage',
);$this->menu=array(
		array('label'=>'List eaAssetOwner', 'url'=>array('index')),
		array('label'=>'Create eaAssetOwner', 'url'=>array('create')),
);Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('ea-asset-owner-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
<div class="page-header">
	<h1>Manage Ea Asset Owners</h1>
</div>
<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>,
	<b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the
	beginning of each of your search values to specify how the comparison
	should be done.
</p>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<?php $this->renderPartial('_search',array(
		'model'=>$model,
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'ea-asset-owner-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
				'id',
				'parent_id',
				'owner',
				'remarks',
				array(
						'class'=>'BootButtonColumn',
				),
		),
)); ?>