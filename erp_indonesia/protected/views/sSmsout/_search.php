<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>
<?php echo $form->textFieldRow($model,'id',array('size'=>20,'maxlength'=>20)); ?>
<?php echo $form->label($model,'sender_id'); ?>
<?php echo $form->textFieldRow($model,'sender_id',array('size'=>11,'maxlength'=>11)); ?>
<?php echo $form->label($model,'modem'); ?>
<?php echo $form->textFieldRow($model,'modem'); ?>
<?php echo $form->label($model,'message'); ?>
<?php echo $form->textFieldRow($model,'message',array('class'=>'span3')); ?>
<?php echo $form->label($model,'created_date'); ?>
<?php echo $form->textFieldRow($model,'created_date',array('size'=>11,'maxlength'=>11)); ?>
<?php
	 echo CHtml::htmlButton('<i class="icon-ok"></i> $model->isNewRecord ? "Create":"Save"', array('class'=>'btn', 'type'=>'submit')); 

?>
<?php $this->endWidget(); ?>
