<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'id'=>'my-form11',
		'type'=>'horizontal', 'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'complete_name',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'company_name',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'title',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'address1',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'address2',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'address3',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'handphone',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'email',array('class'=>'span3')); ?>
<?php echo $form->dropDownListRow($model,'defaultgroup',DAddressbookGroup::items()); ?>
<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>