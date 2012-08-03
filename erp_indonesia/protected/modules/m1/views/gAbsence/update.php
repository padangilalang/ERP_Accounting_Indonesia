<?php
$this->breadcrumbs=array(
		'G people'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m1/gPerson')),

		array('label'=>'View', 'icon'=>'edit', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Delete', 'icon'=>'remove', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
		),
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		<?php echo $model->vc_psnama; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>