<?php
$this->breadcrumbs=array(
		'G people',
);

$this->menu=array(
		array('label'=>'Home','url'=>array('/m1/gLeave')),
		//array('label'=>'Manage gPerson','url'=>array('admin')),
);


$this->menu1=gLeave::getTopUpdated();
$this->menu2=gLeave::getTopCreated();

?>

<div class="pull-right">
	<?php $this->renderPartial('/gPerson/_search',array(
			'model'=>$model,
	)); ?>
</div>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		Leave
	</h1>
</div>


<?php $this->widget('bootstrap.widgets.BootListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>

