<?php $form=$this->beginWidget('BootActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->label($model,'message'); ?>
<?php echo $form->textField($model,'message',array('size'=>60,'maxlength'=>1000)); ?>

<?php echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>
