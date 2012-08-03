<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'id'=>'my-form24',
		'type'=>'horizontal', 'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->dropDownListRow($model,'receivergroup_id',DAddressbookGroup::items()); ?>
<?php echo $form->TextAreaRow($model,'message',array('class'=>'span3', 'rows'=>3)); ?>
<?php
	 echo CHtml::htmlButton('<i class="icon-ok"></i> $model->isNewRecord ? "Create":"Save"', array('class'=>'btn', 'type'=>'submit')); 

?>
<?php $this->endWidget(); ?>