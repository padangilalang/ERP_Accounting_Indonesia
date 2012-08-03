<?php
$this->breadcrumbs=array(
		'Event Management'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

?>

<div class="page-header">
	<h1>
		<?php echo $model->id; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>