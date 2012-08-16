<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'x-product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id'); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_name'); ?>
		<?php echo $form->textField($model,'item_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'item_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo_path'); ?>
		<?php echo $form->textField($model,'photo_path',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'photo_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_id'); ?>
		<?php echo $form->textField($model,'created_id'); ?>
		<?php echo $form->error($model,'created_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_date'); ?>
		<?php echo $form->textField($model,'updated_date'); ?>
		<?php echo $form->error($model,'updated_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_id'); ?>
		<?php echo $form->textField($model,'updated_id'); ?>
		<?php echo $form->error($model,'updated_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->