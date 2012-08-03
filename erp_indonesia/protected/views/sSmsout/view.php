<?php
$this->breadcrumbs=array(
		'Ssmsouts'=>array('index'),
		$model->id,
);$this->menu=array(
		array('label'=>'List SSmsout', 'url'=>array('index')),
		array('label'=>'Create SSmsout', 'url'=>array('create')),
		array('label'=>'Update SSmsout', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete SSmsout', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage SSmsout', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		View SSmsout #
		<?php echo $model->id; ?>
	</h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'sender_id',
				'modem',
				'message',
				'created_date',
		),
)); ?>
