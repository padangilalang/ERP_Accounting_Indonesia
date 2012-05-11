<?php
$this->pageTitle=Yii::app()->name . ' - Help';
$this->breadcrumbs=array(
		'Help',
);
?>

<div class="page-header">
	<h1>Email to Peter (BETA)</h1>
</div>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'c-jemaat-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('hint'=>'Default: '.Yii::app()->user->name,'disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'useremail',array('hint'=>'Default: '.Yii::app()->params['userEmail'],'disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'receiver',array('hint'=>'Default: '.Yii::app()->params['adminEmail'],'disabled'=>'disabled')); ?>

<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5')); ?>

<?php echo $form->textAreaRow($model,'body',array('class'=>'span5', 'rows'=>4)); ?>

<?php if(extension_loaded('gd')): ?>
<?php echo $form->labelEx($model,'verifyCode'); ?>
<?php $this->widget('CCaptcha'); ?>
<?php echo $form->textField($model,'verifyCode'); ?>
<?php endif; ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class'=>'btn', 'type'=>'submit')); ?>
</div>
<?php //echo CHtml::submitButton('Submit'); ?>

<?php $this->endWidget(); ?>

<?php endif; ?>

<!-- Facebook Badge START -->
<a href="http://www.facebook.com/peterjkambey" target="_TOP"
	style="font-family: &amp; amp; amp; amp; amp; amp; amp; quot; lucida grande&amp;amp; amp; amp; amp; amp; amp; quot; , tahoma ,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;"
	title="Peter Jack Kambey">Peter Jack Kambey</a>
<br />
<a href="http://www.facebook.com/peterjkambey" target="_TOP"
	title="Peter Jack Kambey"><img
	src="http://badge.facebook.com/badge/1166386373.377.2084341022.png"
	width="120" height="286" style="border: 0px;" /> </a>
<!-- Facebook Badge END -->
