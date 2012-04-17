<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'item',array('class'=>'span5','maxlength'=>100)); ?>

<div class="actions">
	<?php echo CHtml::submitButton('Search',array('class'=>'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
