<?php
if (isset($model->getparent->getparent->getparent->account_name)) {
	$this->breadcrumbs=array(
			$model->getparent->getparent->getparent->account_name=>array('view','id'=>$model->getparent->getparent->getparent->id),
			$model->getparent->getparent->account_name=>array('view','id'=>$model->getparent->getparent->id),
			$model->getparent->account_name=>array('view','id'=>$model->getparent->id),
			$model->account_name,
	);

} elseif (isset($model->getparent->getparent->account_name)) {
	$this->breadcrumbs=array(
			$model->getparent->getparent->account_name=>array('view','id'=>$model->getparent->getparent->id),
			$model->getparent->account_name=>array('view','id'=>$model->getparent->id),
			$model->account_name,
	);

} elseif (isset($model->getparent->account_name)) {
	$this->breadcrumbs=array(
			$model->getparent->account_name=>array('view','id'=>$model->getparent->id),
			$model->account_name,
	);
} else {
	$this->breadcrumbs=array(
			$model->account_name,
	);
}


$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m2/tAccount')),
		//array('label'=>'Create', 'url'=>array('create')),
		array('label'=>'View', 'icon'=>'zoom-in', 'url'=>array('view', 'id'=>$model->id)),
);

$this->menu1=tAccount::getTopUpdated();
$this->menu2=tAccount::getTopCreated();
$this->menu3=tAccount::getTopRelated($model->account_name);
$this->menu5=array('Account');


?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/tree_diagramm_new.png') ?>
		Update:
		<?php echo $model->account_no .". ".$model->account_name; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_formupdate', array('model'=>$model)); ?>