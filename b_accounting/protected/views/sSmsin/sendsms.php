<?php
$this->breadcrumbs=array(
		'SMS'=>array('index'),
		'Send SMS',
);

?>

<div class="page-header">
	<h1>Send SMS</h1>
</div>
<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'login-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->labelEx($model,'hp'); ?>
<?php echo $form->textField($model,'hp'); ?>
<?php echo $form->error($model,'hp'); ?>
<?php echo $form->labelEx($model,'message'); ?>
<?php echo $form->textField($model,'message',array('size'=>120,'maxlength'=>360)); ?>
<?php echo $form->error($model,'message'); ?>

<?php echo CHtml::submitButton('Send SMS'); ?>

<?php $this->endWidget(); ?>
