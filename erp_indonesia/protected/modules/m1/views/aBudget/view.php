<?php
$this->breadcrumbs=array(
		'Budget'=>array('index'),
		$model->name,
);

$this->menu=array(
		array('label'=>'List aBudget', 'url'=>array('index')),
		array('label'=>'Create aBudget', 'url'=>array('create')),
		array('label'=>'Update aBudget', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete aBudget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage aBudget', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/balance.png') ?>
		View aBudget #
		<?php echo $model->id; ?>
	</h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'parent_id',
				'year',
				'code',
				'name',
				'unit',
				'amount',
				'remark',
		),
)); ?>
