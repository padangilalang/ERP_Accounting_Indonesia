<?php $form=$this->beginWidget('CActiveForm'); ?>
	
		<?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions); ?>
		<?php echo $form->error($model, 'itemname'); ?>

		<?php echo CHtml::submitButton(Rights::t('core', 'Add')); ?>

<?php $this->endWidget(); ?>
