<?php
$this->breadcrumbs=array(
		'Module'=>array('index'),
		'Manage',
);


$this->menu=array(
		
);

$this->menu3=sModule::getTopOther();
$this->menu4=sParameter::getTopOther();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/blockdevice.png') ?>
		Data Module
	</h1>
</div>
<?php 
	//$this->widget('bootstrap.widgets.BootGridView', array(
	$this->widget('ext.groupgridview.GroupGridView', array(
		'extraRowColumns' => array('getparent.title'),
		'id'=>'module-module-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'class'=>'bootstrap.widgets.BootButtonColumn',
						'template'=>'{update}{delete}',
				),
				//array(
				//		'name'=>'id',
				//),
				array(
						'name'=>'getparent.title',
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
				array(
						'header'=>'User List',
						'value'=>'implode($data->getUserList(),", ")'
				),
		),
)); ?>
<hr>

<?php echo $this->renderPartial('_form', array('model'=>$modelmodule)); ?>

