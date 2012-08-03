<?php
$this->breadcrumbs=array(
		'G Cutis'=>array('index'),
		'Create',
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		Create Leave
	</h1>
</div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>