<?php
$this->widget('application.extensions.moneymask.MMask',array(
		'element'=>'#mask',
		'currency'=>'PHP',
		'config'=>array(
				'precision'=>0,
				'thousands'=>'.',
		)
));
?><?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'id'=>'my-form13',
		'type'=>'horizontal', 'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'input_date'); ?>
<?php echo $form->textFieldRow($model,'periode_date'); ?>
<?php echo $form->textFieldRow($model,'item',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'brand',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'type',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'serial_number',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'category_id'); ?>
<?php echo $form->textFieldRow($model,'inventory_code',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'bpb_number',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'po_number',array('class'=>'span3')); ?>
<?php //echo $form->textFieldRow($model,'amount',array('class'=>'span3','id'=>'mask')); ?>
<?php echo $form->textFieldRow($model,'supplier_id'); ?>
<?php echo $form->textFieldRow($model,'warranty',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'insurance',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'remark',array('size'=>60,'maxlength'=>500)); ?>

<?php echo $form->textFieldRow($model,'photo_path',array('size'=>60,'maxlength'=>500)); ?>
<?php echo $form->textFieldRow($model,'accesslevel_id'); ?>
<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>
