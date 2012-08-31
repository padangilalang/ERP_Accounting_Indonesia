<?php
$this->breadcrumbs=array(
	ucfirst($this->module->id)=>array('inbox'),
	ucfirst($this->getAction()->getId())
);


?>
<div class="row-fluid">
<div class="span2">
	<?php
		$this->renderpartial('_menu');
	?>
</div>
<div class="span10">

<?php
$form=$this->beginWidget('BootActiveForm', array(
'id'=>'message-form',
'type'=>'horizontal',
'enableAjaxValidation'=>false,
'htmlOptions'=>array('autocomplete'=>$this->createUrl('ajax/auto')),
)); ?>
	<?php echo CHtml::ErrorSummary($conv); ?>
				<?php echo $form->textFieldRow($conv,'to',array('id'=>'message-to', 'edit'=>$this->module->editToField? '1' : null)); ?>
				
				<?php echo $form->textFieldRow($conv,'subject',array('class'=>'mailbox-input','style'=>'width:100%;','placeholder'=>$this->module->defaultSubject)); ?>
				
		<?php echo $form->textAreaRow($msg,'text',array('cols'=>50,'rows'=>7, 'class'=>'mailbox-message-input','style'=>'width:100%;','placeholder'=>'Enter message here...')); ?>
		
		<div class="form-actions">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Send Message', array('type'=>'submit','class'=>'btn')); ?>
		</div>

<?php $this->endWidget(); ?><!-- form --> 

</div>

