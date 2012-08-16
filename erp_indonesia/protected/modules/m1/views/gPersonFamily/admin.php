<?php
$this->breadcrumbs=array(
		'G Families'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'List gFamily','url'=>array('index')),
		array('label'=>'Create gFamily','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('g-family-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h1>Manage G Families</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>,
	<b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the
	beginning of each of your search values to specify how the comparison
	should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display: none">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
	)); ?>
</div>
<!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
		'id'=>'g-family-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
				'id',
				'parent_id',
				'c_hriskd',
				'vc_nmfm',
				'c_hubfm',
				'vc_hubfm',
				/*
				 'd_tgllhr',
'b_jkel',
'c_templhr',
'b_aktif',
'vc_ket',
'userid',
'tglmodify',
'pt_kodept',
'py_kodeproyek',
'f_cover',
*/
				array(
						'class'=>'bootstrap.widgets.BootButtonColumn',
				),
		),
)); ?>
