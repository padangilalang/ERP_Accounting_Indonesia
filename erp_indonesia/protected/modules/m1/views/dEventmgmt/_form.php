<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(

		'id'=>'my-form12',
		'type'=>'horizontal',

		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model,'event_id',sParameter::items("cEvent")); ?>
<?php echo $form->dropDownListRow($model,'category_id',sParameter::items("cEventCat")); ?>
<?php echo $form->textFieldRow($model,'issue',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'person_incharge',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'todo',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'progress'); ?>
<?php echo $form->textFieldRow($model,'incomplete_exp',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'remark',array('class'=>'span3')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>


<?php $this->endWidget(); ?>
