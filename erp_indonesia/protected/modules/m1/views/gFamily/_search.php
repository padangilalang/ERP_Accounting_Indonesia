<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'parent_id',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'c_hriskd',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'vc_nmfm',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'c_hubfm',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'vc_hubfm',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'d_tgllhr',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'b_jkel',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'c_templhr',array('class'=>'span5','maxlength'=>10)); ?>

<?php echo $form->textFieldRow($model,'b_aktif',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'vc_ket',array('class'=>'span5','maxlength'=>200)); ?>

<?php echo $form->textFieldRow($model,'userid',array('class'=>'span5','maxlength'=>20)); ?>

<?php echo $form->textFieldRow($model,'tglmodify',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'pt_kodept',array('class'=>'span5','maxlength'=>2)); ?>

<?php echo $form->textFieldRow($model,'py_kodeproyek',array('class'=>'span5','maxlength'=>3)); ?>

<?php echo $form->textFieldRow($model,'f_cover',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
	)); ?>
</div>

<?php $this->endWidget(); ?>
