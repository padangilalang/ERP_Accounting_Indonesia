<div class="page-header">
	<h1>
		<?php //echo Yii::app()->name; ?>
	</h1>
</div>


<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'login-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
)); ?>

<?php echo $form->textFieldRow($model,'username',array('class'=>'span3')); ?>
<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3')); ?>
<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class'=>'btn-large', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>

<div class="alert alert-info">
	<h4 class="alert-heading">Note!!</h4>
	This Application IS NOT designed to open with Internet Explorer
	Browser. Please, use Chrome, Firefox or Opera
</div>


<?php /*
<?php $this->beginWidget('bootstrap.widgets.BootHero', array(
		'heading'=>'Welcome !!!...',
)); ?>
<p><?php echo Yii::app()->name; ?> Accounting System Information.  Built with TWO largest and best web application tools. #Yii PHP Framework, the best PHP Framework to control the back end process AND #Bootstrap Twitter, the best web front page design.. </p>
<?php $this->endWidget(); ?>
*/ ?>
