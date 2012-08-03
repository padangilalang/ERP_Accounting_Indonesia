<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
		'id'=>'c-supplier-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'company_name',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'pic',array('class'=>'span3','maxlength'=>40)); ?>

<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'address1',array('class'=>'span4','maxlength'=>20)); ?>

<?php echo $form->textFieldRow($model,'address2',array('class'=>'span3','maxlength'=>30)); ?>

<?php echo $form->textFieldRow($model,'address3',array('class'=>'span3','maxlength'=>30)); ?>

<?php echo $form->textFieldRow($model,'city',array('class'=>'span3','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'pos_code',array('class'=>'span2','maxlength'=>7)); ?>

<?php echo $form->textFieldRow($model,'province',array('class'=>'span2','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'telephone',array('class'=>'span3','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'fax',array('class'=>'span3','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'email',array('class'=>'span3','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'method_id',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'bank_id',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'no_account',array('class'=>'span3','maxlength'=>40)); ?>

<?php echo $form->textFieldRow($model,'atas_nama',array('class'=>'span3','maxlength'=>40)); ?>

<?php echo $form->textFieldRow($model,'status_id',array('class'=>'span3')); ?>


<div class="form-actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
