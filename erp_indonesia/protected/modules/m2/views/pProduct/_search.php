<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'no_polisi',array('class'=>'span5','maxlength'=>15)); ?>

<?php echo $form->textFieldRow($model,'no_bpkb',array('class'=>'span5','maxlength'=>45)); ?>

<?php echo $form->textFieldRow($model,'no_mesin',array('class'=>'span5','maxlength'=>45)); ?>

<?php echo $form->textFieldRow($model,'no_rangka',array('class'=>'span5','maxlength'=>45)); ?>

<div class="actions">
	<?php echo CHtml::submitButton('Search',array('class'=>'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
