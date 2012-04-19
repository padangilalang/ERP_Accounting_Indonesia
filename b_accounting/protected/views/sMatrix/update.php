<?php
$this->breadcrumbs=array(
		'Matrix'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/sMatrix')),
		array('label'=>'View', 'url'=>array('view','id'=>$model->id)),
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/matrix.png') ?>
		<?php echo $model->level; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>