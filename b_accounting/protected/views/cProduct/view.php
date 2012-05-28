<?php
$this->breadcrumbs=array(
		'C Products'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/cProduct')),
		//array('label'=>'Create','url'=>array('create')),
		array('label'=>'Update', 'icon'=>'pencil', 'url'=>array('update','id'=>$model->id)),
		array('label'=>'Delete', 'icon'=>'trash', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

$this->menu5=array('Product');

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/box.png') ?>
		View cProduct #
		<?php echo $model->id; ?>
	</h1>
</div>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'category_id',
				'item',
				'brand',
				'type',
				'serial_number',
				'remark',
				'photo_path',
		),
)); ?>
