<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>
<?php echo $form->textFieldRow($model,'id'); ?>
<?php echo $form->label($model,'parent_id'); ?>
<?php echo $form->textFieldRow($model,'parent_id'); ?>
<?php echo $form->label($model,'owner'); ?>
<?php echo $form->textFieldRow($model,'owner',array('class'=>'span3')); ?>
<?php echo $form->label($model,'remarks'); ?>
<?php echo $form->textAreaRow($model,'remarks',array('rows'=>6, 'cols'=>50)); ?>
<?php echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>
