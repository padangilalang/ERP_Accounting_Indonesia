<?php
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
		'Upload Image',
);
?>

<div class="page-header">
	<h1>Upload File</h1>
</div>

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(

		'id'=>'topic-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'), // ADD THIS
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->labelEx($model,'image'); ?>
<?php echo CHtml::activeFileField($model, 'image'); ?>
<?php
	 echo CHtml::htmlButton('<i class="icon-ok"></i> Search', array('class'=>'btn', 'type'=>'submit')); 
?>
<?php $this->endWidget(); ?>

