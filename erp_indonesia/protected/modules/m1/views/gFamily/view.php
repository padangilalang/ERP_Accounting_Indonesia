<?php
$this->breadcrumbs=array(
		'G Families'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'List gFamily','url'=>array('index')),
		array('label'=>'Create gFamily','url'=>array('create')),
		array('label'=>'Update gFamily','url'=>array('update','id'=>$model->id)),
		array('label'=>'Delete gFamily','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage gFamily','url'=>array('admin')),
);
?>

<h1>
	View gFamily #
	<?php echo $model->id; ?>
</h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'parent_id',
				'c_hriskd',
				'vc_nmfm',
				'c_hubfm',
				'vc_hubfm',
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
	),
)); ?>
