<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
		'id'=>'g-education-form',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'parent_id',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'c_hriskd',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_fmjenjang',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'vc_fmnama',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'c_fmkota',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_fmjurusan',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'n_fmlulus',array('class'=>'span5','maxlength'=>4)); ?>

<?php echo $form->textFieldRow($model,'c_rfnegara',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_institusi',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'userid',array('class'=>'span5','maxlength'=>20)); ?>

<?php echo $form->textFieldRow($model,'tglmodify',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'pt_kodept',array('class'=>'span5','maxlength'=>2)); ?>

<?php echo $form->textFieldRow($model,'py_kodeproyek',array('class'=>'span5','maxlength'=>3)); ?>

<?php echo $form->textFieldRow($model,'pf_ipk',array('class'=>'span5','maxlength'=>5)); ?>

<?php echo $form->textFieldRow($model,'t_jenis',array('class'=>'span5','maxlength'=>10)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
	)); ?>
</div>

<?php $this->endWidget(); ?>
