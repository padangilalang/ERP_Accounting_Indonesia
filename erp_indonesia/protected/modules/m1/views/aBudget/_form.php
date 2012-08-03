
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'id'=>'abudget-form',
		'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'parent_id',array('size'=>11,'maxlength'=>11)); ?>
<?php echo $form->textFieldRow($model,'year'); ?>

<?php echo $form->textFieldRow($model,'code',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'name',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'unit',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'amount',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'remark',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'created_date'); ?>
<?php echo $form->textFieldRow($model,'created_by',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'updated_date'); ?>
<?php echo $form->textFieldRow($model,'updated_by',array('class'=>'span3')); ?>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<?php $this->endWidget(); ?>