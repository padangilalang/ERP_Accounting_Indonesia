<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'t-account-entity-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->errorSummary($model); ?>


<?php echo $form->dropDownListRow($model,'entity_id',aOrganization::items()); ?>
<?php echo $form->textAreaRow($model,'remark',array('class'=>'span3','rows'=>3)); ?>
<?php echo $form->dropDownListRow($model,'state_id',sParameter::items("cStatusP")); ?>
<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
