<?php
$this->breadcrumbs=array(
		'Abudgets'=>array('index'),
		$model->name=>array('view','id'=>$model->id),
		'Update',

);$this->menu=array(
		array('label'=>'List aBudget', 'url'=>array('index')),
		array('label'=>'Create aBudget', 'url'=>array('create')),
		array('label'=>'View aBudget', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage aBudget', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/balance.png') ?>
		Update aBudget
		<?php echo $model->id; ?>
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>