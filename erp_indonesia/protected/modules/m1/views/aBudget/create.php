<?php
$this->breadcrumbs=array(
		'Abudgets'=>array('index'),
		'Create',
);$this->menu=array(
		array('label'=>'List aBudget', 'url'=>array('index')),
		array('label'=>'Manage aBudget', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/balance.png') ?>
		Create aBudget
	</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>