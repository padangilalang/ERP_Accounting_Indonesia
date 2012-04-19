<?php
$this->breadcrumbs=array(
		'C Suppliers'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'List cSupplier','url'=>array('index')),
		array('label'=>'Create cSupplier','url'=>array('create')),
		array('label'=>'View cSupplier','url'=>array('view','id'=>$model->id)),
		array('label'=>'Manage cSupplier','url'=>array('admin')),
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/lorrygreen.png') ?>
		Update cSupplier
		<?php echo $model->id; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>