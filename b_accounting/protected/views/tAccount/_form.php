<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'t-account-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model,'haschild_id',sParameter::items("cHasChild")); ?>
<?php echo $form->textFieldRow($model,'account_no',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'account_name',array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model,'short_description',array('class'=>'span4','rows'=>3)); ?>
<?php //echo $form->dropDownListRow($model,'currency_id',sParameter::items("cCurrency","*inherited*")); ?>
<?php echo $form->textFieldRow($model,'beginning_balance',array('class'=>'span3','hint'=>'Input this field with started amount for this account')); ?>
<?php //echo $form->dropDownListRow($model,'state_id',sParameter::items("cStatus","*inherited*")); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create':'<i class="icon-ok"></i> Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>


<?php $this->endWidget(); ?>
