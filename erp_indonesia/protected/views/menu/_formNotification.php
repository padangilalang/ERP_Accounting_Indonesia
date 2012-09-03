<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
		'id'=>'my-form30',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->dropDownListRow($model, 'receiver_id', sUser::model()->allUsers()); ?>

<?php echo $form->textAreaRow($model,'long_desc',array('rows'=>'4','class'=>'span4')); ?>

	<div class="form-actions">
		<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Send', array('class'=>'btn', 'type'=>'submit')); ?>
	</div>

<?php $this->endWidget(); ?>
