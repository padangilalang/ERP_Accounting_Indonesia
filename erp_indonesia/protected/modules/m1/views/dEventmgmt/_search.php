

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(

		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>


<?php echo $form->textFieldRow($model,'id'); ?>
<?php echo $form->textFieldRow($model,'event_id'); ?>
<?php echo $form->textFieldRow($model,'issue_number',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'category_id'); ?>
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
