<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(

		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>


<?php echo $form->textFieldRow($model,'nama',array('class'=>'span3')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>


<?php $this->endWidget(); ?>
