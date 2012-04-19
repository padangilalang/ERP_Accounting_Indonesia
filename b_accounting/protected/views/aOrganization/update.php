<?php
if ($model->structure_id ==3) {
	$this->breadcrumbs=array(
			$model->getparent->getparent->name=>array('view','id'=>$model->getparent->getparent->id),
			$model->getparent->name=>array('view','id'=>$model->getparent->id),
			$model->name,
	);

} elseif ($model->structure_id ==2) {
	$this->breadcrumbs=array(
			$model->getparent->name=>array('view','id'=>$model->getparent->id),
			$model->name,
	);
} else {
	$this->breadcrumbs=array(
			$model->name,
	);
}

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/aOrganization')),
		array('label'=>'Create', 'url'=>array('create')),
		array('label'=>'View', 'url'=>array('view', 'id'=>$model->id)),
);

$this->menu1=aOrganization::getTopUpdated();
$this->menu2=aOrganization::getTopCreated();
$this->menu3=aOrganization::getTopRelated($model->id);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/document_organization_chart_01.png') ?>
		Update:
		<?php echo $model->name; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>