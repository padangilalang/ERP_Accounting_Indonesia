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
);

$this->menu1=aOrganization::getTopUpdated();
$this->menu2=aOrganization::getTopCreated();

?>

<div class="page-header">
	<h1>Create New Organization</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>