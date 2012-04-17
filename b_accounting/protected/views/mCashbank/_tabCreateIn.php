<h2>
	<?php echo (isset($model->system_ref) ? "Update: ". $model->system_ref : "") ?>
</h2>

<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'u-journal-formIn',
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
				'id'=>'g1',
				'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->input_date),
				'attribute'=>'input_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
						'minDate'=> '-20',
						'maxDate'=>'+1M +10D',
						//'changeYear'=>true,
				),
				'htmlOptions'=>array(
						'style'=>'height:20px;'
				),
		));
		?>
	</div>
</div>

<?php //echo $form->dropDownListRow($model,'yearmonth_periode',array(Yii::app()->settings->get("System", "cCurrentPeriod")=>Yii::app()->settings->get("System", "cCurrentPeriod"))); ?>

<?php echo $form->dropDownListRow($model,'var_account',tAccount::cashBankAccount()); ?>
<?php echo $form->textFieldRow($model,'cb_received_from',array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model,'remark',array('class'=>'span5','rows'=>3)); ?>

<?php $this->widget('ext.appendo.JAppendo',array(
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
