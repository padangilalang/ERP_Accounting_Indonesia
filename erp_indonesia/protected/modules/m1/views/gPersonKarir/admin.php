<?php
$this->breadcrumbs=array(
		'G Karirs'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'List gKarir','url'=>array('index')),
		array('label'=>'Create gKarir','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('g-karir-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h1>Manage G Karirs</h1>

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
		'id'=>'g-karir-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
				'id',
				'parent_id',
				'i_idkarir',
				'c_hriskd',
				'd_awalkr',
				'd_akhirkr',
				/*
				 'c_unitkr',
'c_direkkr',
'c_golkr',
'c_pangkatkr',
'c_jabatankr',
'c_nmjabatankr',
'c_departkr',
'c_stskr',
'c_perushkr',
'vc_lokasikr',
'vc_alasankr',
'c_alhriskd',
'c_lokasikr',
'c_alasankr',
'userid',
'tglmodify',
'pt_kodept',
'py_kodeproyek',
't_status',
't_stat',
*/
				array(
						'class'=>'bootstrap.widgets.BootButtonColumn',
				),
		),
)); ?>
