<?php
$this->breadcrumbs=array(
		'Module'=>array('index'),
		$model->title,
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/sModule')),
);

$this->menu4=sModule::getTopOther();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/blockdevice.png') ?>
		<?php echo $model->title; ?>
	</h1>
</div>

<?php 
$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				'parent_id',
				'title',
				'description',
				'link',
		),
));


?>

<h2>User on this Module</h2>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'user-module-grid',
		'dataProvider'=>sUser::model()->searchModule($model->id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'name'=>'username',
						'type'=>'raw',
						'value'=>'CHtml::link($data->username,Yii::app()->createUrl("/sUser/view",array("id"=>$data->id)))',
				),
				array(
						'name'=>'default_group',
						'type'=>'raw',
						'value'=>'CHtml::link($data->organization->name,Yii::app()->createUrl("/aOrganization/view",array("id"=>$data->default_group)))',
				),
				array(
						'name'=>'status_id',
						'value'=>'$data->status->name',
				),

		),
)); ?>
