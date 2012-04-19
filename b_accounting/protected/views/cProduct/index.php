<?php
$this->breadcrumbs=array(
		'C Products',
);

$this->menu=array(
		array('label'=>'Create cProduct','url'=>array('create')),
		array('label'=>'Manage cProduct','url'=>array('admin')),
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/box.png') ?>
		C Products
	</h1>
</div>

<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
