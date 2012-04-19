<?php
$this->breadcrumbs=array(
		'User'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/sUser')),
		array('label'=>'View', 'url'=>array('view','id'=>$model->id)),
);

$this->menu2=sUser::getTopCreated();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		<?php echo $model->username; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_formPassword', array('model'=>$model)); ?>