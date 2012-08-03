<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>
<?php echo $form->label($model,'complete_name'); ?>
<?php echo $form->textFieldRow($model,'complete_name',array('class'=>'span3')); ?>
<?php echo $form->label($model,'company_name'); ?>
<?php echo $form->textFieldRow($model,'company_name',array('class'=>'span3')); ?>
<?php echo $form->label($model,'title'); ?>
<?php echo $form->textFieldRow($model,'title',array('class'=>'span3')); ?>
<?php echo $form->label($model,'handphone'); ?>
<?php echo $form->textFieldRow($model,'handphone',array('class'=>'span3')); ?>
<?php echo $form->label($model,'email'); ?>
<?php echo $form->textFieldRow($model,'email',array('class'=>'span3')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class'=>'btn', 'type'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>
