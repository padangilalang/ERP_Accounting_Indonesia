<?php $form=$this->beginWidget('BootActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->label($model,'title'); ?>
<?php echo $form->textField($model,'title',array('class'=>'span3')); ?>

<?php echo CHtml::submitButton('Search'); ?>

<?php $this->endWidget(); ?>
