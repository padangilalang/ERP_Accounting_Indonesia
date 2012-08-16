<?php
$this->breadcrumbs=array(
		'Ssmsouts'=>array('index'),
		'Manage',
);$this->menu=array(
		array('label'=>'List SSmsout', 'url'=>array('index')),
		array('label'=>'Create SSmsout', 'url'=>array('create')),
);Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('ssmsout-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
<div class="page-header">
	<h1>Manage Ssmsouts</h1>
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
<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'ssmsout-grid',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				'id',
				'sender_id',
				'modem',
				'message',
				'created_date',
				array(
						'class'=>'BootButtonColumn',
				),
		),
)); ?>