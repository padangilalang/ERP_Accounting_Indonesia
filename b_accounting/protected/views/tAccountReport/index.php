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
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'periode_date',array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$model,
					//'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->periode_date),
					'attribute'=>'periode_date',
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yymm', 
					),
					'htmlOptions'=>array(
					),
			));
			?>
		</div>
	</div>

	<?php echo $form->dropDownListRow($model, 'report_id', tAccountReport::accountReportList()); ?>
	
	<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-print"></i> Report', array('class'=>'btn', 'type'=>'submit')); ?>
	</div>
	
<?php $this->endWidget(); ?>

