<?php
$this->breadcrumbs=array(
		'SMS'=>array('index'),
		'Manage',
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('ssmsin-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<div class="page-header">
	<h1>Data SMS</h1>
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
	<?php echo CHtml::link('Add New', array('create')); 
	echo CHtml::label(' | ','#');
	echo CHtml::link('Advanced Search', '#',array('onclick'=>'$("#advancedsearch_dialog").dialog("open"); return false;',))
	?>
</div>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'ssmsin-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'class'=>'BootButtonColumn',
				),
				'filename',
				'cfrom',
				'sent',
				'received',
				'modem',
				'message',
		),
)); ?>
