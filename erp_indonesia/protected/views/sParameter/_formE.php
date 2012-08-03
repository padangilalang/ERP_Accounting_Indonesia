<?php 

$form=$this->beginWidget('BootActiveForm', array(
		'id'=>'parameter-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->dropDownListRow($model,'type',sParameter::items2("ALL")); ?>

<?php echo $form->textFieldRow($model,'code'); ?>

<?php echo $form->textFieldRow($model,'name',array('class'=>'span3')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create':'<i class="icon-ok"></i> Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>


<?php $this->endWidget(); ?>