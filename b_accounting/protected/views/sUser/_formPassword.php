<?php 

$form=$this->beginWidget('BootActiveForm', array(
		'id'=>'user-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
)); ?>

<?php echo $form->textFieldRow($model, 'salt', array('disabled'=>true)); ?>
<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3')); ?>
<?php //echo $form->passwordFieldRow($model,'password_repeat',array('class'=>'span3',)); ?>


<div class="form-actions">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create':'<i class="icon-ok"></i> Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>