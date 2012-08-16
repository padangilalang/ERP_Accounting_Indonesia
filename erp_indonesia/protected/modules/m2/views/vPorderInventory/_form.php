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

<div class="row-fluid">
<div class="span12">
<?php $form=$this->beginWidget('BootActiveForm', array(
	'id'=>'b-porder-detail-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'input_date'); ?>

	<?php echo $form->dropDownListRow($model,'supplier_id',cSupplier::items()); ?>

	<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'class'=>'span5')); ?>

	
	<div id="xForm">
		<?php echo $this->renderPartial('_formDetail', array('model'=>$model,'dataProvider'=>$dataProvider)); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'item_name',array("class"=>"control-label")); ?>
	<div class="controls">

		<?php 
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'item_name',
			'sourceUrl' => Yii::app()->createUrl('/m2/xProduct/xProductAutoComplete'),
			'options'=>array(
				'minLength'=>'2',
				'focus'=> 'js:function( event, ui ) {
					$("#'.CHtml::activeId($model,'item_name').'").val(ui.item.label);
					return false;
				}',
				'select'=>'js:function( event, ui ) {
					$("#'.CHtml::activeId($model,'item_id').'").val(ui.item.id);
					return false;
				}',			
			),
			'htmlOptions'=>array(
				
			),
		));  
		?>
		<?php echo $form->hiddenField($model,'item_id',array('class'=>'span3')); ?>
	</div>
	</div>

	<?php echo $form->textFieldRow($model,'description',array('size'=>60,'maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'qty'); ?>

	<?php echo $form->textFieldRow($model,'amount',array('size'=>15,'maxlength'=>15)); ?>

	<div class="form-actions">
		<?php
			if (!isset($model->id)) { //new
				echo CHtml::ajaxSubmitButton('Add Row',Yii::app()->createUrl($this->route),array('update'=>'#xForm')); 
			} else //update
				echo CHtml::ajaxSubmitButton('Add Row',Yii::app()->createUrl($this->route,array("id"=>$model->id)),array('update'=>'#xForm')); 
		?>
		<?php echo CHtml::SubmitButton('Create'); ?>
		<?php echo CHtml::link('Close',array('/m2/vPorderInventory/deleteTemp'),array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div><!-- form -->
