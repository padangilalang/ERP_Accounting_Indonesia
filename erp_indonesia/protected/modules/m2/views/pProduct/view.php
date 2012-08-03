<?php
$this->breadcrumbs=array(
		'P Products'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'List pProduct','url'=>array('index')),
		array('label'=>'Create pProduct','url'=>array('create')),
		array('label'=>'Update pProduct','url'=>array('update','id'=>$model->id)),
		array('label'=>'Delete pProduct','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage pProduct','url'=>array('admin')),
);
?>

<h1>
	View pProduct #
	<?php echo $model->id; ?>
</h1>

<?php 
$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'no_polisi',
				'warna',
				'no_bpkb',
				'stnk_berlaku_sd',
				'no_mesin',
				'no_rangka',
				'created_date',
				'created_id',
				'updated_date',
				'updated_id',
		),
)); ?>
