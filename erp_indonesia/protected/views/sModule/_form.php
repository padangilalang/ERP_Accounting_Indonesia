<?php 

$form=$this->beginWidget('BootActiveForm', array(
		'id'=>'module-module-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->dropDownListRow($model,'parent_id',sModule::items()); ?>

<?php echo $form->textFieldRow($model,'sort',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'title',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'description',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'link',array('class'=>'span3')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create':'<i class="icon-ok"></i> Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>


<?php $this->endWidget(); ?>

