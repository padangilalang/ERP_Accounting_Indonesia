<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>
<?php echo $form->textFieldRow($model,'item',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'brand',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'type',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'serial_number',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'inventory_code',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'bpb_number',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'po_number',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'supplier_id'); ?>
<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>
