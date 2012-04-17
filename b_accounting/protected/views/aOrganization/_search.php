<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
		'id'=>'searchForm',
		'type'=>'inline',
)); ?>

<?php echo $form->textFieldRow($model, 'name', array('class'=>'input-medium')); ?>
<?php echo CHtml::htmlButton('<i class="icon-search"></i> Search', array('class'=>'btn','type'=>'submit')); ?>

<?php $this->endWidget(); ?>

