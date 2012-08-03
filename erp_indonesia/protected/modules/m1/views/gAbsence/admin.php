<?php
$this->breadcrumbs=array(
		'G people'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'List gPerson','url'=>array('index')),
		array('label'=>'Create gPerson','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('g-person-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h1>Manage G people</h1>

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
		'id'=>'g-person-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
				'id',
				'c_hriskd',
				'c_proyek',
				'c_pt',
				'c_direktorat',
				'c_pskode',
				/*
				 'vc_psnama',
'vc_pstemlhr',
'd_pstgllhr',
'b_psjkel',
'c_rfagama',
'c_psstskw',
'c_stspjk',
'c_rfkwarga',
't_domalamat',
'vc_domkec',
'c_domcity',
'c_dompos',
'c_psktp',
'd_psktp',
't_psalamat',
'vc_pskec',
'c_rfcity',
'c_pskdpos',
'vc_psemail',
'vc_psemail2',
'c_rfdarah',
'vc_psnotelp',
'vc_psnohp',
'vc_psnohp2',
'vc_pshobby',
'c_psaktif',
'c_kdaktif',
't_psaktifket',
'd_joinunit',
'd_joingrp',
'b_sambung',
'c_pathfoto',
'userid',
'tglmodify',
'pt_kodept',
'py_kodeproyek',
't_status',
't_status2',
'created_date',
'created_id',
'updated_date',
'updated_id',
*/
				array(
						'class'=>'bootstrap.widgets.BootButtonColumn',
				),
		),
)); ?>
