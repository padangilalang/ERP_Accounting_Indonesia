<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/jquery-ui.css');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');


Yii::app()->clientScript->registerScript('datepicker', "
	$(function() {
		$( \"#".CHtml::activeId($model,'input_date')."\" ).datepicker({
			
			'dateFormat' : 'dd-mm-yy',
		});
		$( \"#".CHtml::activeId($model,'input_date')."\" ).mask('99-99-9999');
	});

");
?>


<?php
$this->breadcrumbs=array(
		'Journal Voucher'=>array('/m2/uJournal'),
		'Update',
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m2/uJournal')),
		array('label'=>'View', 'icon'=>'zoom-in', 'url'=>array('view', 'id'=>$model->master_id)),
);

$this->menu1=uJournal::getTopUpdated(1);
$this->menu2=uJournal::getTopCreated(1);


?>


<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Update:
		<?php echo $model->system_ref; ?>
	</h1>
</div>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'u-journal-form',
		//'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'input_date'); ?>

<?php //echo $form->dropDownListRow($model,'yearmonth_periode',array(Yii::app()->settings->get("System", "cCurrentPeriod")=>Yii::app()->settings->get("System", "cCurrentPeriod"))); ?>

<?php echo $form->textAreaRow($model,'remark',array('rows'=>3, 'class'=>'span5')); ?>


<?php $this->widget('ext.appendo2.JAppendo',array(
		'id' => 'repeateEnum',
		'model' => $model,
		'viewName' => '_detailJournal',
		'labelDel' => 'Remove Row'
		//'cssFile' => 'css/jquery.appendo2.css'
)); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Update', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
