<div class="wide form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route),
			'method'=>'get',
	)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'for_position'); ?>
		<?php echo $form->textField($model,'for_position',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'for_project'); ?>
		<?php echo $form->textField($model,'for_project',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'candidate_name'); ?>
		<?php echo $form->textField($model,'candidate_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'birthdate'); ?>
		<?php echo $form->textField($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quick_background'); ?>
		<?php echo $form->textField($model,'quick_background',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'work_experience'); ?>
		<?php echo $form->textField($model,'work_experience',array('size'=>60,'maxlength'=>1500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sallary_expectation'); ?>
		<?php echo $form->textField($model,'sallary_expectation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'source_id'); ?>
		<?php echo $form->textField($model,'source_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'followup_date'); ?>
		<?php echo $form->textField($model,'followup_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'followup_id'); ?>
		<?php echo $form->textField($model,'followup_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'followup_remark'); ?>
		<?php echo $form->textField($model,'followup_remark',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview1_date'); ?>
		<?php echo $form->textField($model,'interview1_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview1_by'); ?>
		<?php echo $form->textField($model,'interview1_by',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview1_result'); ?>
		<?php echo $form->textField($model,'interview1_result',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview2_date'); ?>
		<?php echo $form->textField($model,'interview2_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview2_by'); ?>
		<?php echo $form->textField($model,'interview2_by',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview2_result'); ?>
		<?php echo $form->textField($model,'interview2_result',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview3_date'); ?>
		<?php echo $form->textField($model,'interview3_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview3_by'); ?>
		<?php echo $form->textField($model,'interview3_by',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interview3_result'); ?>
		<?php echo $form->textField($model,'interview3_result',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'review'); ?>
		<?php echo $form->textField($model,'review',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_result_id'); ?>
		<?php echo $form->textField($model,'final_result_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'general_remark'); ?>
		<?php echo $form->textField($model,'general_remark',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_id'); ?>
		<?php echo $form->textField($model,'created_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_date'); ?>
		<?php echo $form->textField($model,'updated_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_id'); ?>
		<?php echo $form->textField($model,'updated_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
