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

		<?php echo $form->textFieldRow($model,'username',array('class'=>'span3')); ?>
		<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3')); ?>
		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

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

