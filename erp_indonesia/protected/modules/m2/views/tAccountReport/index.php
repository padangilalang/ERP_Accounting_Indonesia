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


<?php
$this->breadcrumbs=array(
	'Account Report',
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/report.png') ?>
		Accounting Report
	</h1>
</div>



<?php $form=$this->beginWidget('BootActiveForm', array(
	'id'=>'allocation-form',
	'enableAjaxValidation'=>false, 'type'=>'horizontal',
)); ?>

	
	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->textFieldRow($model,'periode_date'); ?>

	<?php echo $form->dropDownListRow($model, 'report_id', tAccountReport::accountReportList()); ?>
	
	<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-print"></i> Report', array('class'=>'btn', 'type'=>'submit')); ?>
	</div>
	
<?php $this->endWidget(); ?>

