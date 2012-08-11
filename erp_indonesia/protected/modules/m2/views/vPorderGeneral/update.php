<?php
$this->breadcrumbs=array(
		'Purchase Order'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m2/vPorder')),
);

$this->menu1=vPorder::getTopUpdated(2);
$this->menu2=vPorder::getTopCreated(2);?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/shopcart.png') ?>
		Update PO <small>Update current PO</small>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
