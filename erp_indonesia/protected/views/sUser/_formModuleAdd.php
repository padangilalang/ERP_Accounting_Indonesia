<?php $this->widget( 'ext.EChosen.EChosen', array(
		'target' => 'select',
)); ?>

<?php 

$form=$this->beginWidget('BootActiveForm', array(
		'id'=>'matrix-user-module-form1',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 's_module_id', sModule::itemsAll(),array('class'=>'span8','multiple'=>'multiple')); ?>

<?php echo $form->dropDownListRow($model,'s_matrix_id', sMatrix::items('sMatrix'),array('class'=>'span3')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create':'<i class="icon-ok"></i> Save', array('class'=>'btn', 'type'=>'submit')); ?>
	<?php //echo CHtml::htmlButton('Close', array('class'=>'btn', 'type'=>'reset')); ?>
</div>

<?php $this->endWidget(); ?>
