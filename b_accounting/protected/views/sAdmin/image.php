<?php
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
		'Upload Image',
);
?>

<div class="page-header">
	<h1>Upload File</h1>
</div>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'topic-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'), // ADD THIS
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->fileFieldRow($model, 'image'); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>


