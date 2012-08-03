<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/css/jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/jui-bootstrap/jquery-ui-1.8.16.custom.css');


Yii::app()->clientScript->registerScript('datepicker', "
	$(function() {
		$( \"#".CHtml::activeId($model,'input_date')."\" ).datepicker({
			
			'dateFormat' : 'dd-mm-yy',
		});
	});

");
?>

<h2>
	<?php echo (isset($model->system_ref) ? "Update: ". $model->system_ref : "") ?>
</h2>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'u-journal-formIn',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'input_date'); ?>

<?php //echo $form->dropDownListRow($model,'yearmonth_periode',array(Yii::app()->settings->get("System", "cCurrentPeriod")=>Yii::app()->settings->get("System", "cCurrentPeriod"))); ?>

<?php echo $form->dropDownListRow($model,'var_account',tAccount::cashBankAccount()); ?>
<?php echo $form->textFieldRow($model,'cb_received_from',array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model,'remark',array('class'=>'span5','rows'=>3)); ?>

<?php $this->widget('ext.appendo2.JAppendo',array(
		'id' => 'repeateEnum2',
		'model' => $model,
		'viewName' => '_detailJournal',
		'labelDel' => 'Remove Row'
		//'cssFile' => 'css/jquery.appendo2.css'
)); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Save Income', array('class'=>'btn', 'type'=>'submit')); ?>
</div>


<?php $this->endWidget(); ?>
