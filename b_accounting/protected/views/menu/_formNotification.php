<?php 

$form=$this->beginWidget('BootActiveForm', array(
		'id'=>'snotification-form',
		//'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->dropDownListRow($model, 'receiver_id', sUser::model()->allUsers()); ?>

<?php echo $form->TextAreaRow($model,'long_desc',array('rows'=>2, 'class'=>'span5')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>Share', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
