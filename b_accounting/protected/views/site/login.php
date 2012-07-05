<div class="page-header">
	<h1>
		<?php //echo Yii::app()->name; ?>
	</h1>
</div>

<?php 

$browser=checkBrowser::getInstance()->getBrowser();

if ($browser['name'] =='Internet Explorer') 
	header("Location: not_support.php");

?>

<div class="row-fluid">
	<div class="span6 well">
		<?php $form=$this->beginWidget('BootActiveForm', array(
				'id'=>'login-form',
				'type'=>'horizontal',
				'enableAjaxValidation'=>true,
		)); ?>

		<?php echo $form->errorSummary($model); ?>
		
		<?php echo $form->textFieldRow($model,'username',array('class'=>'span3')); ?>
		<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3')); ?>
		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

		<?php if($model->scenario == 'captchaRequired'): ?>
			<div class="control-group">
				<?php echo $form->labelEx($model,'verifyCode',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php $this->widget('CCaptcha'); ?>
					<?php echo $form->TextField($model,'verifyCode'); ?>
				</div>
			</div>
        <?php endif; ?>
		
		<div class="form-actions">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class'=>'btn-large', 'type'=>'submit')); ?>
		</div>

		<?php $this->endWidget(); ?>
	</div>
	<div class="span5">
		<?php 
		$_slide="slide".Yii::app()->dateFormatter->format("d",time()).".JPG";
		echo CHtml::image(Yii::app()->request->baseUrl.'/images/photo/'.$_slide,'image',array('style'=>'width: 100%')); ?>
	</div>
</div>

<br/>

<div class="row-fluid">
	<div class="span12">
		<div class="alert alert-info">
			<h4 class="alert-heading">Note!!</h4>
			In the reason for speed development and concentrate on business process and workflow process, this application HAS DESIGNED to open with Chrome, Firefox or Opera. Internet Explorer will be banned automatically...
		</div>
	</div>
</div>

<?php
//Yii::app()->settings->set("System", "cCurrentPeriod", "201203", $toDatabase=true);  
//Yii::app()->settings->deleteCache();
//echo Yii::app()->settings->get("System", "cCurrentPeriod");

?>