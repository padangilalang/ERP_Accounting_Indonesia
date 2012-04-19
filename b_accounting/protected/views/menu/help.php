<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
		'Contact',
);
?>

<div class="page-header">
	<h1>Email to Peter</h1>
</div>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->labelEx($model,'username'); ?>
<?php echo Yii::app()->user->name; ?>

<?php echo $form->labelEx($model,'useremail'); ?>
<?php echo Yii::app()->params['userEmail']; ?>

<?php echo $form->labelEx($model,'receiver'); ?>
<?php echo Yii::app()->params['adminEmail']; ?>

<?php echo $form->labelEx($model,'subject'); ?>
<?php echo $form->textField($model,'subject',array('class'=>'span3')); ?>

<?php echo $form->labelEx($model,'body'); ?>
<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>

<?php if(extension_loaded('gd')): ?>
<?php echo $form->labelEx($model,'verifyCode'); ?>
<?php $this->widget('CCaptcha'); ?>
<?php echo $form->textField($model,'verifyCode'); ?>
<?php endif; ?>

<?php echo CHtml::submitButton('Submit'); ?>

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
