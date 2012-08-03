<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'t-account-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model,'accmain_id',tAccountMain::items()); ?>
<?php echo $form->textFieldRow($model,'account_no',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'account_name',array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model,'short_description',array('class'=>'span5','rows'=>3)); ?>
<?php echo $form->dropDownListRow($model,'currency_id',sParameter::items("cCurrency")); ?>
<?php echo $form->dropDownListRow($model,'state_id',sParameter::items("cStatusP")); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>

