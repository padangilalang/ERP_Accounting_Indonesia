<?php
$this->breadcrumbs=array(
		'Chart of Accounts',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/tAccount')),
		array('label'=>'Create New Root Account', 'url'=>array('create')),
		array('label'=>'Print List', 'url'=>array('printList')),
);


$this->menu1=tAccount::getTopUpdated();
//$this->menu2=tAccount::getTopCreated();


?>

<div class="pull-right">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
	)); ?>
</div>

<div class="page-header">
		<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/tree_diagramm_new.png') ?>
	Chart of Accounts</h1>
</div>

<?php $this->widget('zii.widgets.CListView', array(
		//$this->widget('ext.bootstrap.widgets.BootListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>

<?php //$this->renderPartial('_view',array(
//		'dataProvider'=>$dataProvider,
//	)); ?>
