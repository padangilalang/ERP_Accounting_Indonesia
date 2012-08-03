<?php 

$form=$this->beginWidget('BootActiveForm', array(
		'id'=>'user-module-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'username',array('class'=>'span3')); ?>

<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3')); ?>

<?php echo $form->dropDownListRow($model,'default_group',aOrganization::model()->getRootList()); ?>

<?php echo $form->dropDownListRow($model,'status_id',sParameter::items("cStatus")); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create':'<i class="icon-ok"></i> Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
