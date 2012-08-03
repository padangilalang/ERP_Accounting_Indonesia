<?php
$this->breadcrumbs=array(
		'G Educations'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'List gEducation','url'=>array('index')),
		array('label'=>'Create gEducation','url'=>array('create')),
		array('label'=>'Update gEducation','url'=>array('update','id'=>$model->id)),
		array('label'=>'Delete gEducation','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage gEducation','url'=>array('admin')),
);
?>

<h1>
	View gEducation #
	<?php echo $model->id; ?>
</h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'parent_id',
				'c_hriskd',
				'c_fmjenjang',
				'vc_fmnama',
				'c_fmkota',
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
	),
)); ?>
