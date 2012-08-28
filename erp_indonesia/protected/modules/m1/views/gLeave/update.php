<?php
$this->breadcrumbs=array(
		'G Cutis'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
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
		Update:
		<?php echo $model->person->vc_psnama; ?>
	</h1>
</div>



<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>