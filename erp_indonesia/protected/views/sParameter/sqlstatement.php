<?php
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
		'SQL Statement',
);
?>

<div class="page-header">
	<h1>SQL Statement</h1>
</div>



<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm'); ?>

<?php echo $form->textAreaRow($model,'sql',array('rows'=>8, 'class'=>'span12')); ?>
<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Execute', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>


