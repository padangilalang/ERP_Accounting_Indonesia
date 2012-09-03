<?php if( $model->scenario==='update' ): ?>

	<h3><?php echo Rights::getAuthItemTypeName($model->type); ?></h3>

<?php endif; ?>
	
<?php //$form=$this->beginWidget('CActiveForm'); ?>
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'id'=>'aPorder-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

		<?php echo $form->textFieldRow($model, 'name', array('maxlength'=>255, 'class'=>'text-field',
		'hint'=>Rights::t('core', 'Do not change the name unless you know what you are doing.'))); ?>

		<?php echo $form->textFieldRow($model, 'description', array('maxlength'=>255, 'class'=>'text-field',
		'hint'=>Rights::t('core', 'A descriptive name for this item.'))); ?>

	<?php if( Rights::module()->enableBizRule===true ): ?>

			<?php echo $form->textFieldRow($model, 'bizRule', array('maxlength'=>255, 'class'=>'text-field',
			'hint'=>Rights::t('core', 'Code that will be executed when performing access checking.'))); ?>

	<?php endif; ?>

	<?php if( Rights::module()->enableBizRule===true && Rights::module()->enableBizRuleData ): ?>

			<?php echo $form->labelEx($model, 'data'); ?>
			<?php echo $form->textField($model, 'data', array('maxlength'=>255, 'class'=>'text-field',
			'hint'=>Rights::t('core', 'Additional data available when executing the business rule.'))); ?>

	<?php endif; ?>

	<div class="form-actions">
		<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.Rights::t('core', 'Save'), array('class'=>'btn', 'type'=>'submit')); ?>
		<?php echo CHtml::link(Rights::t('core', 'Cancel'),Yii::app()->user->rightsReturnUrl,array('class'=>'btn')); ?>

	</div>

<?php $this->endWidget(); ?>
