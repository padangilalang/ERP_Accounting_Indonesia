<?php
$this->breadcrumbs=array(
		'Chart of Accounts'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m2/tAccount')),
);

$this->menu1=tAccount::getTopUpdated();
$this->menu2=tAccount::getTopCreated();


?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/tree_diagramm_new.png') ?>
		Create New Root Account
	</h1>
</div>

<?php echo $this->renderPartial('_formroot', array('model'=>$model)); ?>