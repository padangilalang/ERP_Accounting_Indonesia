<?php
	$this->pageTitle=Yii::app()->name . ' - Help';
	$this->breadcrumbs=array(
		'Help',
	);
?>

<div class="page-header">
<h1>Email (BETA)</h1>
</div>

<div class="raw-fluid">
<div class="span11">
<?php 
	$form=$this->beginWidget('BootActiveForm', array(
	'id'=>'c-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
	)); 
?>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'username',array('hint'=>'Default: '.Yii::app()->user->name,'disabled'=>'disabled')); ?>
	<?php //echo $form->textFieldRow($model,'useremail',array('hint'=>'Default: '.Yii::app()->params['userEmail'],'disabled'=>'disabled')); ?>
	<?php //echo $form->textFieldRow($model,'receiver',array('hint'=>'Default: '.Yii::app()->params['adminEmail'],'disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5')); ?>
	<?php echo $form->textAreaRow($model,'body',array('class'=>'span5', 'rows'=>4)); ?>

	<?php 
		if(extension_loaded('gd')): 
			echo $form->labelEx($model,'verifyCode'); 
			$this->widget('CCaptcha');
			echo $form->textField($model,'verifyCode'); 
		endif; 
	?>

	<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class'=>'btn', 'type'=>'submit')); ?>
	</div>
	<?php //echo CHtml::submitButton('Submit'); ?>

<?php $this->endWidget(); ?>


</div>
<div class="span1">
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
</div>
</div>
