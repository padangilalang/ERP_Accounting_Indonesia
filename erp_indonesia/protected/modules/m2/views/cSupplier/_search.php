<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'company_name',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'pic',array('class'=>'span5','maxlength'=>40)); ?>

<div class="actions">
	<?php echo CHtml::submitButton('Search',array('class'=>'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
