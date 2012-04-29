<?php
$this->breadcrumbs=array(
		'Print List Journal',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/tAccount')),
);


?>

<div class="page-header">
	<h1>Print List Journal</h1>
</div>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'allocation-form',
		//'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>


<?php //echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'account_no_id', tAccount::item()); ?>

<?php echo $form->labelEx($model,'begindate'); ?>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model'=>$model,
		'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->begindate),
		'attribute'=>'begindate',
		// additional javascript options for the date picker plugin
		'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'dd-mm-yy',
		),
		'htmlOptions'=>array(
				'style'=>'height:24px;'
		),
));


?>
<?php 
/*
$this->widget('ext.monthpicker.MonthPicker', array(
    'model'=>$model,
    'name'=>'begindate',
));
*/
?>

<?php echo $form->error($model,'begindate'); ?>

<?php echo $form->labelEx($model,'enddate'); ?>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model'=>$model,
		'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->enddate),
		'attribute'=>'enddate',
		// additional javascript options for the date picker plugin
		'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'dd-mm-yy',
		),
		'htmlOptions'=>array(
				'style'=>'height:24px;'
		),
));
?>

<?php echo $form->labelEx($model,'type_report_id'); ?>
<?php echo $form->dropDownList($model,'type_report_id',array(
		'1'=>'Summary Style',
		'2'=>'Detail Style',
)); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Report', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
