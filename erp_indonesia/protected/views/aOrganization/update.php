<?php
$this->breadcrumbs=array(
		$model->name,
);

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
		Update:
		<?php echo $model->name; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>