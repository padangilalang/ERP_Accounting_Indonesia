<?php
/* @var $this BPorderDetailController */
/* @var $model vPorderDetail */

$this->breadcrumbs=array(
	'B Porder Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Home', 'icon'=>'home','url'=>array('/m2/vPorderInventory')),
);

$this->menu1=vPorder::getTopUpdated(1);
$this->menu2=vPorder::getTopCreated(1);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		Create
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model,'dataProvider'=>$dataProvider)); ?>
