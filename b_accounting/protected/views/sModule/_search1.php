<?php $form=$this->beginWidget('BootActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->textField($model,'title',array('size'=>20,'maxlength'=>50)); ?>
<?php echo CHtml::submitButton('Search'); ?>

<?php $this->endWidget(); ?>
