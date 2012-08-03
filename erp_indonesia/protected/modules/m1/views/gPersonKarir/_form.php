<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
		'id'=>'g-karir-form',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'parent_id',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'i_idkarir',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'c_hriskd',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'d_awalkr',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'d_akhirkr',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'c_unitkr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_direkkr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_golkr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_pangkatkr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_jabatankr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_nmjabatankr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_departkr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_stskr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_perushkr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'vc_lokasikr',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'vc_alasankr',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'c_alhriskd',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_lokasikr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_alasankr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'userid',array('class'=>'span5','maxlength'=>20)); ?>

<?php echo $form->textFieldRow($model,'tglmodify',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'pt_kodept',array('class'=>'span5','maxlength'=>2)); ?>

<?php echo $form->textFieldRow($model,'py_kodeproyek',array('class'=>'span5','maxlength'=>3)); ?>

<?php echo $form->textFieldRow($model,'t_status',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'t_stat',array('class'=>'span5','maxlength'=>1)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
	)); ?>
</div>

<?php $this->endWidget(); ?>
