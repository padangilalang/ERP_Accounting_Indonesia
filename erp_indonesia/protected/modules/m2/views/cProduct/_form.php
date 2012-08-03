<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
		'id'=>'c-product-form',
		'enableAjaxValidation'=>false,
		'type'=>'horizontal',
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'category_id',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'item',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'brand',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'serial_number',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'remark',array('class'=>'span5','maxlength'=>500)); ?>

<?php echo $form->textFieldRow($model,'photo_path',array('class'=>'span5','maxlength'=>500)); ?>

<div class="actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
