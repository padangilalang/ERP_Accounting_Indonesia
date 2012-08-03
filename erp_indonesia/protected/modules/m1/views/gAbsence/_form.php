<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
		'id'=>'g-person-form',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'c_hriskd',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_proyek',array('class'=>'span5','maxlength'=>3)); ?>

<?php echo $form->textFieldRow($model,'c_pt',array('class'=>'span5','maxlength'=>2)); ?>

<?php echo $form->textFieldRow($model,'c_direktorat',array('class'=>'span5','maxlength'=>2)); ?>

<?php echo $form->textFieldRow($model,'c_pskode',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'vc_psnama',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'vc_pstemlhr',array('class'=>'span5','maxlength'=>20)); ?>

<?php echo $form->textFieldRow($model,'d_pstgllhr',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'b_psjkel',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'c_rfagama',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_psstskw',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_stspjk',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_rfkwarga',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'t_domalamat',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'vc_domkec',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'c_domcity',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_dompos',array('class'=>'span5','maxlength'=>5)); ?>

<?php echo $form->textFieldRow($model,'c_psktp',array('class'=>'span5','maxlength'=>25)); ?>

<?php echo $form->textFieldRow($model,'d_psktp',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'t_psalamat',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'vc_pskec',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'c_rfcity',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_pskdpos',array('class'=>'span5','maxlength'=>5)); ?>

<?php echo $form->textFieldRow($model,'vc_psemail',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'vc_psemail2',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'c_rfdarah',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'vc_psnotelp',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'vc_psnohp',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'vc_psnohp2',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'vc_pshobby',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->textFieldRow($model,'c_psaktif',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'c_kdaktif',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textAreaRow($model,'t_psaktifket',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<?php echo $form->textFieldRow($model,'d_joinunit',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'d_joingrp',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'b_sambung',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'c_pathfoto',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'userid',array('class'=>'span5','maxlength'=>20)); ?>

<?php echo $form->textFieldRow($model,'tglmodify',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'pt_kodept',array('class'=>'span5','maxlength'=>2)); ?>

<?php echo $form->textFieldRow($model,'py_kodeproyek',array('class'=>'span5','maxlength'=>3)); ?>

<?php echo $form->textFieldRow($model,'t_status',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'t_status2',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
	)); ?>
</div>

<?php $this->endWidget(); ?>
