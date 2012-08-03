
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'id'=>'ea-asset-location-form',
		'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'parent_id'); ?>
<?php echo $form->textFieldRow($model,'location',array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model,'remarks',array('rows'=>6, 'cols'=>50)); ?>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<?php $this->endWidget(); ?>