<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/jquery-ui.css');

Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
	$(function() {
		$( \"#".CHtml::activeId($model,'payment_date')."\" ).datepicker({
			
			'dateFormat' : 'dd-mm-yy',
		});
		$( \"#".CHtml::activeId($model,'effective_date')."\" ).datepicker({
			
			'dateFormat' : 'dd-mm-yy',
		});
		$( \"#".CHtml::activeId($model,'payment_date')."\" ).mask('99-99-9999');
		$( \"#".CHtml::activeId($model,'effective_date')."\" ).mask('99-99-9999');
	});

");
?>

<h2>Payment</h2>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'a-porder-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'payment_date'); ?>

<?php echo $form->dropDownListRow($model,'payment_source_id',tAccount::cashbankAccount()); ?>

<?php echo $form->dropDownListRow($model,'payment_type_id',array('1'=>'Cash','2'=>'Cheque/Giro')); ?>

<?php echo $form->textAreaRow($model,'description',array('rows'=>2, 'class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'amount',array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model,'effective_date'); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Create', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
