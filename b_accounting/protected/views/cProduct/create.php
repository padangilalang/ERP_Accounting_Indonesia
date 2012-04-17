<?php
$this->breadcrumbs=array(
		'C Products'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'List cProduct','url'=>array('index')),
		array('label'=>'Manage cProduct','url'=>array('admin')),
);
?>

<div class="page-header">
	<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/box.png') ?>
	Create cProduct</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>