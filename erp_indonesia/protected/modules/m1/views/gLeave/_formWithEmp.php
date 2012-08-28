<?php /*
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		'model'=>$model,
		'attribute'=>'nig',
		'sourceUrl' => Yii::app()->createUrl('/bphgbi/cJemaat/NamaAutoComplete'),
		'options'=>array(
				'minLength'=>'2',
				'focus'=> 'js:function( event, ui ) {
				$("#'.CHtml::activeId($model,'nig').'").val(ui.item.label);
				return false;
				}',
				'select'=>'js:function( event, ui ) {
				$("#'.CHtml::activeId($model,'nig_id').'").val(ui.item.id);
				return false;
				}',
		),
		'htmlOptions'=>array(

		),
));

*/ ?>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/jquery-ui.css');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#".CHtml::activeId($model,'d_cuti')."\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#".CHtml::activeId($model,'d_dari')."\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#".CHtml::activeId($model,'d_sampai')."\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#".CHtml::activeId($model,'d_h_masuk')."\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
});
		$( \"#".CHtml::activeId($model,'d_cuti')."\" ).mask('99-99-9999');
		$( \"#".CHtml::activeId($model,'d_dari')."\" ).mask('99-99-9999');
		$( \"#".CHtml::activeId($model,'d_sampai')."\" ).mask('99-99-9999');
		$( \"#".CHtml::activeId($model,'d_h_masuk')."\" ).mask('99-99-9999');
		$( \"#".CHtml::activeId($model,'n_jmlhari')."\" ).mask('9?9');

});

		");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
		'id'=>'g-cuti-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="control-group">
	<?php echo $form->labelEx($model,'parent_name',array('class'=>'control-label')); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model,
				'attribute'=>'parent_name',
				'source'=>$this->createUrl('/m1/gPerson/personAutoComplete'),
				'options'=>array(
						'minLength'=>'2',
						'focus'=> 'js:function( event, ui ) {
						$("#'.CHtml::activeId($model,'parent_name').'").val(ui.item.label);
						return false;
}',
						'select'=> 'js:function( event, ui ) {
						$("#'.CHtml::activeId($model,'parent_id').'").val(ui.item.id);
						return false;
}',
				),
				'htmlOptions'=>array(
						'class'=>'input-medium',
						'placeholder'=>'Search Name',
						'class'=>'span4',
				),
		));
			
		?>
	</div>
</div>
<?php echo $form->hiddenField($model,'parent_id'); ?>

<?php echo $form->textFieldRow($model,'d_cuti'); ?>

<?php echo $form->textFieldRow($model,'d_dari'); ?>

<?php echo $form->textFieldRow($model,'d_sampai'); ?>

<?php echo $form->textFieldRow($model,'n_jmlhari',array('class'=>'span1','hint'=>'Total days of leaving')); ?>

<?php echo $form->textFieldRow($model,'d_h_masuk'); ?>

<?php echo $form->textAreaRow($model,'r_cuti',array('class'=>'span5','rows'=>4)); ?>

<?php //echo $form->textFieldRow($model,'c_ganti',array('class'=>'span5','maxlength'=>10,'hint'=>'Your office mate as replacement during your leave')); ?>
<div class="control-group">
	<?php echo $form->labelEx($model,'c_ganti',array('class'=>'control-label')); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model,
				'attribute'=>'c_ganti',
				'source'=>$this->createUrl('/m1/gPerson/personAutoComplete'),
				'options'=>array(
						'minLength'=>'2',
						//'focus'=> 'js:function( event, ui ) {
						//	$("#'.CHtml::activeId($model,'c_ganti').'").val(ui.item.label);
						//	return false;
						//}',
				),
				'htmlOptions'=>array(
						'class'=>'input-medium',
						'placeholder'=>'Search Name',
						'class'=>'span4',
				),
		));
			
		?>
	</div>
</div>



<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
	)); ?>
</div>

<?php $this->endWidget(); ?>
