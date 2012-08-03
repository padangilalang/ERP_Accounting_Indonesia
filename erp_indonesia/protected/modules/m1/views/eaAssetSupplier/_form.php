
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'id'=>'ea-asset-supplier-form',
		'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'supplier_name',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'telpon',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'fax',array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model,'remarks',array('rows'=>6, 'cols'=>50)); ?>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<?php $this->endWidget(); ?>