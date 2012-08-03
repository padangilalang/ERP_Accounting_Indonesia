<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>
<?php echo $form->textFieldRow($model,'id'); ?>
<?php echo $form->label($model,'supplier_name'); ?>
<?php echo $form->textFieldRow($model,'supplier_name',array('class'=>'span3')); ?>
<?php echo $form->label($model,'telpon'); ?>
<?php echo $form->textFieldRow($model,'telpon',array('class'=>'span3')); ?>
<?php echo $form->label($model,'fax'); ?>
<?php echo $form->textFieldRow($model,'fax',array('class'=>'span3')); ?>
<?php echo $form->label($model,'remarks'); ?>
<?php echo $form->textAreaRow($model,'remarks',array('rows'=>6, 'cols'=>50)); ?>
<?php echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>
