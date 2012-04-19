<?php
$this->breadcrumbs=array(
		'Journal Voucher',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/uJournal')),
		array('label'=>'Create', 'url'=>array('create')),
);


$this->menu1=uJournal::getTopUpdated(1);
$this->menu2=uJournal::getTopCreated(1);



?>

<div class="pull-right">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
	)); ?>
</div>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Journal Voucher
	</h1>
</div>

<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		//'template'=>'{summary}{items}'
		//'sortableAttributes'=>array(
		//   'updated_date',
		//    'entity.name',
		//),
)); ?>

