<?php
$this->breadcrumbs=array(
		'Journal Voucher'=>array('/uJournal'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/uJournal')),
);

$this->menu1=uJournal::getTopUpdated(1);
$this->menu2=uJournal::getTopCreated(1);


?>


<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Journal Voucher
	</h1>
</div>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'u-journal-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="control-group">
	<?php echo $form->labelEx($model,'input_date',array('class'=>'control-label')); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'value'=>CTimestamp::formatDate('dd-MM-yyyy',$model->input_date),
				'attribute'=>'input_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
						'minDate'=> '-20',
						'maxDate'=>'+1M +10D',
				),
				'htmlOptions'=>array(
						
				),
		));
		?>
	</div>
</div>

<?php //echo $form->dropDownListRow($model,'yearmonth_periode',array(Yii::app()->settings->get("System", "cCurrentPeriod")=>Yii::app()->settings->get("System", "cCurrentPeriod"))); ?>

<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'class'=>'span5')); ?>

<?php $this->widget('ext.appendo.JAppendo',array(
		'id' => 'repeateEnum',
		'model' => $model,
		'viewName' => '_detailJournal',
		'labelDel' => 'Remove Row'
		//'cssFile' => 'css/jquery.appendo2.css'
)); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Create', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
