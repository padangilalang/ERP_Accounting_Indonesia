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


<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Modal header</h3>
</div>
 
<div class="modal-body">
    <?php $this->renderPartial('_search', array('model'=>$model)); ?>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
 
<?php echo CHtml::link('Click me','#modal', array('class'=>'btn btn-primary', 'data-toggle'=>'modal')); ?>
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
						'class'=>'bootstrap.widgets.BootButtonColumn',
				),
				'filename',
				'cfrom',
				'sent',
				'received',
				'modem',
				'message',
		),
)); ?>
