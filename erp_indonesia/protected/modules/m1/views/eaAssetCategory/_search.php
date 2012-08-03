<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>
<?php echo $form->textFieldRow($model,'id'); ?>
<?php echo $form->label($model,'parent_id'); ?>
<?php echo $form->textFieldRow($model,'parent_id'); ?>
<?php echo $form->label($model,'inventory_type'); ?>
<?php echo $form->textFieldRow($model,'inventory_type',array('class'=>'span3')); ?>
<?php echo $form->label($model,'type1_info'); ?>
<?php echo $form->textFieldRow($model,'type1_info',array('class'=>'span3')); ?>
<?php echo $form->label($model,'type2_info'); ?>
<?php echo $form->textFieldRow($model,'type2_info',array('class'=>'span3')); ?>
<?php echo $form->label($model,'remarks'); ?>
<?php echo $form->textAreaRow($model,'remarks',array('rows'=>6, 'cols'=>50)); ?>
<?php echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>
