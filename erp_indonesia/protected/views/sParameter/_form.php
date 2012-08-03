<?php 

$form=$this->beginWidget('BootActiveForm', array(
		'id'=>'parameter-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<div class="control-group">
	<?php echo $form->labelEx($model,'type',array('class'=>'control-label')); ?>
	<div class="controls">
		<?php
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model'=>$model,
					'attribute'=>'type',
					'value'=>$this->createUrl('SParameter/TParameter'),
					'source'=>$this->createUrl('SParameter/TParameter'),
					'options'=>array(
							'minLength'=>'2',
					),
					'htmlOptions'=>array(
							
					),
			));
		?>
	</div>
</div>


<?php echo $form->textFieldRow($model,'code'); ?>

<?php echo $form->textFieldRow($model,'name',array('class'=>'span3')); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="icon-ok"></i> Create':'<i class="icon-ok"></i> Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>


<?php $this->endWidget(); ?>
