<?php
$this->breadcrumbs=array(
		'G Educations'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'List gEducation','url'=>array('index')),
		array('label'=>'Create gEducation','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('g-education-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h1>Manage G Educations</h1>

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
		'id'=>'g-education-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
				'id',
				'parent_id',
				'c_hriskd',
				'c_fmjenjang',
				'vc_fmnama',
				'c_fmkota',
				/*
				 'c_fmjurusan',
'n_fmlulus',
'c_rfnegara',
'c_institusi',
'userid',
'tglmodify',
'pt_kodept',
'py_kodeproyek',
'pf_ipk',
't_jenis',
*/
				array(
						'class'=>'bootstrap.widgets.BootButtonColumn',
				),
		),
)); ?>
