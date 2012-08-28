<?php
$this->breadcrumbs=array(
		'G Recruitments'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
);

$this->menu=array(
		array('label'=>'List gRecruitment', 'url'=>array('index')),
		array('label'=>'Create gRecruitment', 'url'=>array('create')),
		array('label'=>'View gRecruitment', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage gRecruitment', 'url'=>array('admin')),
);
?>

<h1>
	Update gRecruitment
	<?php echo $model->id; ?>
</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>