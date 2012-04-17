<?php 

$form=$this->beginWidget('BootActiveForm', array(
		'id'=>'snotification3-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->dropDownListRow($model, 'category_id', sParameter::items("cCategory")); ?>

<?php echo $form->textAreaRow($model,'long_desc',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Share':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>

