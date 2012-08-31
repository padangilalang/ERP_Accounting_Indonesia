<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(

		'id'=>'my-form31',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->dropDownListRow($model, 'category_id', sParameter::items("cCategory")); ?>
<?php echo $form->textFieldRow($model,'long_desc',array('class'=>'span3')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>


<?php $this->endWidget(); ?>
