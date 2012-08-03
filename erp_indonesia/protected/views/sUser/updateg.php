<?php
$this->breadcrumbs=array(
		'User Management'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

?>

<div class="page-header">
	<h1>
		<?php echo sUser::model()->findByPk((int)$sid)->username; ?>
	</h1>
</div>

<?php echo $this->renderPartial('_form1', array('model'=>$model)); ?>