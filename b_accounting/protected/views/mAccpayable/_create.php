<h2>Payment</h2>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'a-porder-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>


<div class="control-group">
	<?php echo $form->labelEx($model,'payment_date',array('class'=>'control-label')); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->payment_date),
				'attribute'=>'payment_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
						'minDate'=> '-20',
						'maxDate'=>'+1M +10D',
				),
				'htmlOptions'=>array(
						'style'=>'height:20px;'
				),
		));
		?>
	</div>
</div>

<?php echo $form->dropDownListRow($model,'payment_source_id',tAccount::cashbankAccount()); ?>

<?php echo $form->dropDownListRow($model,'payment_type_id',array('1'=>'Cash','2'=>'Cheque/Giro')); ?>

<?php echo $form->textAreaRow($model,'description',array('rows'=>2, 'class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'amount',array('class'=>'span3')); ?>

<div class="control-group">
	<?php echo $form->labelEx($model,'effective_date',array('class'=>'control-label')); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->effective_date),
				'attribute'=>'effective_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
						'minDate'=> '-20',
						'maxDate'=>'+1M +10D',
				),
				'htmlOptions'=>array(
						'style'=>'height:20px;'
				),
		));
		?>
	</div>
</div>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Create', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
