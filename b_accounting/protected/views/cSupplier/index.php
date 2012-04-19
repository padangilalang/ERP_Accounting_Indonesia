<?php
$this->breadcrumbs=array(
		'C Suppliers',
);

$this->menu=array(
		array('label'=>'Create cSupplier','url'=>array('create')),
		array('label'=>'Manage cSupplier','url'=>array('admin')),
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/lorrygreen.png') ?>
		Data Supplier
	</h1>
</div>

<?php $this->widget('zii.widgets.CListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
