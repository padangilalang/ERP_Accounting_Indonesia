<?php
$this->breadcrumbs=array(
		'Daddressbooks'=>array('index'),
		$model->title,
);$this->menu=array(
		array('label'=>'List DAddressbook', 'url'=>array('index')),
		array('label'=>'Create DAddressbook', 'url'=>array('create')),
		array('label'=>'Update DAddressbook', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete DAddressbook', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage DAddressbook', 'url'=>array('admin')),
);
?>
<div class="page-header">
	<h1>
		View DAddressbook #
		<?php echo $model->id; ?>
	</h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'id',
				'complete_name',
				'company_name',
				'title',
				'address1',
				'address2',
				'address3',
				'handphone',
				'email',
		),
)); ?>
