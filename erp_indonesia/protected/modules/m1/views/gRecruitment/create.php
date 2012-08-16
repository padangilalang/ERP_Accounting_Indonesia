<?php
$this->breadcrumbs=array(
		'Recruitment'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home ', 'icon'=>'home', 'url'=>array('/m1/gRecruitment')),
);


?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		Create
	</h1>
</div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>