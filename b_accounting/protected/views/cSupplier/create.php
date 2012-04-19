<?php
$this->breadcrumbs=array(
		'C Suppliers'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'List cSupplier','url'=>array('index')),
		array('label'=>'Manage cSupplier','url'=>array('admin')),
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/lorrygreen.png') ?>
		Create cSupplier
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>