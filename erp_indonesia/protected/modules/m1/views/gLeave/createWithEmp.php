<?php
$this->breadcrumbs=array(
		'G Cutis'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home','url'=>array('/m1/gLeave')),
		//array('label'=>'Manage gPerson','url'=>array('admin')),
);

$this->menu1=gLeave::getTopUpdated();
$this->menu2=gLeave::getTopCreated();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		Create Leave
	</h1>
</div>


<?php echo $this->renderPartial('_formWithEmp', array('model'=>$model)); ?>