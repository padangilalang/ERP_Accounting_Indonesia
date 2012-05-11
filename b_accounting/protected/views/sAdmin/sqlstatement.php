<?php
$this->pageTitle=Yii::app()->name . ' - SQL Statement';
$this->breadcrumbs=array(
		'SQL Statement',
);
?>

<div class="page-header">
	<h1>SQL Statement Execution (BETA)</h1>
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



<?php echo $form->textAreaRow($model,'sql',array('class'=>'span5', 'rows'=>4)); ?>


<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class'=>'btn', 'type'=>'submit')); ?>
</div>
<?php //echo CHtml::submitButton('Submit'); ?>

<?php $this->endWidget(); ?>

<?php endif; ?>

