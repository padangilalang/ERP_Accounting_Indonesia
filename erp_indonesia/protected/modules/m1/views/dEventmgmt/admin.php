<?php
$this->breadcrumbs=array(
		'Event Management'=>array('index'),
		'Manage',
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('deventmgmt-grid', {
		data: $(this).serialize()
});
		return false;
});
		");

?>

<div class="page-header">
	<h1>Event Management</h1>
</div>

<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',
		array('id'=>'advancedsearch_dialog',
				// additional javascript options for the dialog plugin
				'options'=>array(
						'title'=>'Advanced Search',
						'width'=>'auto',
						'autoOpen'=>false,
				),
		));
$this->renderPartial('_search', array('model'=>$model));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<div class="mymenu">

	<?php echo CHtml::link('Advanced Search', '#',array('onclick'=>'$("#advancedsearch_dialog").dialog("open"); return false;',));
	?>
</div>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'deventmgmt-grid',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'class'=>'BootButtonColumn',
				),
				array(
						'name'=>'event_id',
						'value'=>'sParameter::item("cEvent",$data->event_id)',
				),
				'id',
				array(
						'name'=>'category_id',
						'value'=>'sParameter::item("cEventCat",$data->category_id)',
				),
				'issue',
				'person_incharge',
				'todo',
				'progress',
				'incomplete_exp',
				'created_by',
		),
)); ?>
<hr />
<?php 
$this->renderPartial('_form', array('model'=>$modelevent));
?>

