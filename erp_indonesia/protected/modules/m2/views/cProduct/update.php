<?php
$this->breadcrumbs=array(
		'C Products'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'List cProduct','url'=>array('index')),
		array('label'=>'Create cProduct','url'=>array('create')),
		array('label'=>'View cProduct','url'=>array('view','id'=>$model->id)),
		array('label'=>'Manage cProduct','url'=>array('admin')),
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/box.png') ?>
		Update cProduct
		<?php echo $model->id; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>