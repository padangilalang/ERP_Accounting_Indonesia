<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'t-account-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>


<?php //echo $form->errorSummary($model); ?>

<?php //echo $form->labelEx($model,'module_id'); ?>
<?php //echo $form->dropDownList($model,'module_id',sParameter::items("cModule"),array('prompt'=>'Choose Module:')); ?>
<?php //echo $form->error($model,'module_id'); ?>

<div class="form-actions">
	<?php //echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
