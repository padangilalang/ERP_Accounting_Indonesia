<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'c-jemaat-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>


<?php echo $form->textFieldRow($model,'branch_code',array('class'=>'span3',)); ?>
<?php echo $form->textFieldRow($model,'name',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'address',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'address2',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'address3',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'address4',array('class'=>'span3')); ?>

<?php /*
<?php echo $form->labelEx($model,'propinsi_id'); ?>
<?php
echo $form->dropDownList($model,'propinsi_id',sKabupatenPropinsi::items("Any"),
		array(
				'empty'=>'select Propinsi:',
				'ajax' => array(
						'type'=>'POST',
						'url'=>CController::createUrl('aOrganization/kabupatenUpdate'),
						'update'=>'#'.CHtml::activeId($model,'kabupaten_id'),
				)
		)
);

?>
*/ ?>

<?php echo $form->dropDownListRow($model,'kabupaten_id',array()); ?>

<?php echo $form->textFieldRow($model,'pos_code',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'phone_code_area',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'telephone',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'fax',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'email',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'website',array('class'=>'span3')); ?>


<div class="form-actions">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create':'<i class="icon-ok"></i> Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>

