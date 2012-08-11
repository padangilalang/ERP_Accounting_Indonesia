<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/jquery-ui.css');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');


Yii::app()->clientScript->registerScript('datepicker', "
	$(function() {
		$( \"#".CHtml::activeId($model,'input_date')."\" ).datepicker({
			
			'dateFormat' : 'dd-mm-yy',
		});
		$( \"#".CHtml::activeId($model,'input_date')."\" ).mask('99-99-9999');
	});

");
?>


<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'id'=>'bporder-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
));
?>
<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'input_date'); ?>
<?php /*		
<div class="control-group">
		<?php echo $form->labelEx($model,'periode_date',array("class"=>"control-label")); ?>
		<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'id'=>'balance-begin1',
				'value'=>CTimestamp::formatDate('yyyy-MM-dd',$model->periode_date),
				'attribute'=>'periode_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yymm',
				),
				'htmlOptions'=>array(
						
				),
		));
		?>
		</div>
		</div>
		*/ ?>

<?php //echo $form->dropDownListRow($model,'budgetcomp_id',tAccount::purchasingAccount()); ?>

<?php echo $form->dropDownListRow($model,'supplier_id',cSupplier::items()); ?>

<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'class'=>'span5')); ?>

<?php 
$this->widget('ext.appendo2.JAppendo',array(
		'id' => 'repeateEnum',
		'model' => $model,
		'viewName' => '_detailPorderGeneral',
		'labelDel' => 'Remove Row'
		//'cssFile' => 'css/jquery.appendo2.css'
));
?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>
