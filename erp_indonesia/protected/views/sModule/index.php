<?php
$this->breadcrumbs=array(
		'Module'=>array('index'),
		'Manage',
);


$this->menu=array(
		//array('label'=>'Create', 'url'=>array('create')),
);

$this->menu4=sModule::getTopOther();

?>

<div class="page-header">
	<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/blockdevice.png') ?>
	Data Module</h1>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'module-module-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{update}{delete}',
				),
				array(
						'name'=>'id',
				),
				array(
						'name'=>'parent_id',
				),
				array(
						'name'=>'sort',
				),
				array(
					'name'=>'title',
					'type'=>'raw',
					'value'=>'CHtml::link("$data->title",Yii::app()->createUrl("/sModule/view",array("id"=>$data->id)))'
				),
				'link',
		),
)); ?>
<hr>

<?php echo $this->renderPartial('_form', array('model'=>$modelmodule)); ?>

