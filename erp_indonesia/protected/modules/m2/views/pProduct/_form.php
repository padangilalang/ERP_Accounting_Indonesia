<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
		'id'=>'p-product-form',
		'enableAjaxValidation'=>false,
		'type'=>'horizontal',
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'no_polisi',array('class'=>'span3','maxlength'=>15)); ?>

<?php echo $form->textFieldRow($model,'warna',array('class'=>'span3','maxlength'=>15)); ?>

<?php echo $form->textFieldRow($model,'no_bpkb',array('class'=>'span3','maxlength'=>45)); ?>

<?php echo $form->textFieldRow($model,'stnk_berlaku_sd',array('class'=>'span3','maxlength'=>45)); ?>

<?php echo $form->textFieldRow($model,'no_mesin',array('class'=>'span3','maxlength'=>45)); ?>

<?php echo $form->textFieldRow($model,'no_rangka',array('class'=>'span3','maxlength'=>45)); ?>

<div class="form-actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
