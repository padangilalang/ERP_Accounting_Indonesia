<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'t-account-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>


<?php //echo $form->errorSummary($model); ?>

<?php //echo $form->labelEx($model,'module_id'); ?>
<?php //echo $form->dropDownList($model,'module_id',sParameter::items("cModule"),array('prompt'=>'Choose Module:')); ?>
<?php //echo $form->error($model,'module_id'); ?>

<?php
//$this->widget('zii.widgets.jui.CJuiButton', array(
//'buttonType'=>'submit',
//'name'=>'btn',
//'caption'=>$model->isNewRecord ? 'Create':'Save',
//'options'=>array('icons'=>'js:{secondary:"ui-icon-extlink"}'),
//));
?>

<?php $this->endWidget(); ?>
