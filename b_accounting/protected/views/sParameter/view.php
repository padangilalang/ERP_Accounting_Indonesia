<?php
$this->breadcrumbs=array(
		'Parameter'=>array('index'),
		$model->name,
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/ms_dos_batch_file.png') ?>
		<?php echo CHtml::encode($model->name); ?>
	</h1>
</div>
<?php
$this->widget('ext.JuiButtonSet.JuiButtonSet', array(
		'items' => array(
				array(
						'label'=>'List View',
						'icon-position'=>'left',
						'url'=>array('admin'),
				),
				array(
						'label'=>'Update',
						'icon-position'=>'left',
						'url'=>array('update', 'id'=>$model->id),
				),
		),
		'htmlOptions' => array('style' => 'clear: both;'),
));
?>

<?php 

$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'name',
				'code',
				'type',
		),
)); ?>
