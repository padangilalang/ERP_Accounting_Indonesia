<?php
$this->breadcrumbs=array(
		'G Karirs'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'List gKarir','url'=>array('index')),
		array('label'=>'Create gKarir','url'=>array('create')),
		array('label'=>'Update gKarir','url'=>array('update','id'=>$model->id)),
		array('label'=>'Delete gKarir','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage gKarir','url'=>array('admin')),
);
?>

<h1>
	View gKarir #
	<?php echo $model->id; ?>
</h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'parent_id',
				'i_idkarir',
				'c_hriskd',
				'd_awalkr',
				'd_akhirkr',
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
		),
)); ?>
