<?php $form=$this->beginWidget('BootActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->label($model,'long_desc'); ?>
<?php echo $form->textField($model,'long_desc',array('size'=>60,'maxlength'=>250)); ?>

<?php echo CHtml::submitButton('Search'); ?>

<?php $this->endWidget(); ?>
