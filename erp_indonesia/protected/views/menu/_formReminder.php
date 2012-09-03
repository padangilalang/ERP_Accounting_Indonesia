<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
		'id'=>'example-form',
		//'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'subject',array('class'=>'span3','style'=>'height:28px;')); ?>
<div class="control-group">
	<?php echo $form->labelEx($model,'start_date',array("class"=>"control-label")); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				//'value'=>cTimestamp::formatDate('yyyy-MM-dd',$model->start_date),
				'attribute'=>'start_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
				),
				'htmlOptions'=>array(
						'style'=>'height:28px;'
				),
		));
		?>
	</div>
</div>
<div class="control-group">
	<?php echo $form->labelEx($model,'end_date',array("class"=>"control-label")); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				//'value'=>cTimestamp::formatDate('yyyy-MM-dd',$model->end_date),
				'attribute'=>'end_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
				),
				'htmlOptions'=>array(
						'style'=>'height:28px;'
				),
		));
		?>
	</div>
</div>
<div class="control-group">
	<?php echo $form->labelEx($model,'reminder',array('class'=>'control-label')); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				//'value'=>cTimestamp::formatDate('yyyy-MM-dd',$model->reminder),
				'attribute'=>'reminder',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',
				),
				'htmlOptions'=>array(
						'style'=>'height:28px;'
				),
		));
		?>
	</div>
</div>

<?php echo $form->dropDownListRow($model,'status_id',sParameter::items("cStatusTask")); ?>
<?php echo $form->dropDownListRow($model,'priority_id',sParameter::items("cPriority")); ?>
<?php echo $form->dropDownListRow($model,'category_id',sParameter::items("cTaskCategory")); ?>
<?php echo $form->textAreaRow($model,'notes',array('rows'=>3, 'class'=>'span4')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
