<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/css/jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/jui-bootstrap/jquery-ui-1.8.16.custom.css');


Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
		$( \"#".CHtml::activeId($model,'input_date')."\" ).datepicker({
			
		'dateFormat' : 'dd-mm-yy',
});
});
		$(function() {
		$( \"#".CHtml::activeId($model,'periode_date')."\" ).datepicker({
			
		'dateFormat':'yymm',
});
});

		");
?>


<?php
$this->breadcrumbs=array(
		'Purchase Order 07 with Dept'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/m1/aPorder07')),
		array('label'=>'Create Simple PO', 'url'=>array('create')),
);

$this->menu1=aPorder::getTopUpdated07();
$this->menu2=aPorder::getTopCreated07();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Create New PO 07 with Dept
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'Create PO','url'=>Yii::app()->createUrl('create')),
				array('label'=>'Create PO With Dept','url'=>Yii::app()->createUrl('createDept')),
				array('label'=>'Create Non PO','url'=>Yii::app()->createUrl('create')),
		),
));
?>

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'id'=>'aPorder-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'input_date'); ?>

<?php echo $form->textFieldRow($model,'no_ref',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'periode_date'); ?>

<?php echo $form->dropDownListRow($model,'budgetcomp_id',aBudget::mainComponent()); ?>


<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'cols'=>50)); ?>


<?php echo $form->dropDownListRow($model,'issuer_id',sParameter::items("cIssuer")); ?>

<div class="tabular">
	<?php $this->widget('ext.appendo.JAppendo',array(
			'id' => 'repeateEnum',
			'model' => $model,
			'viewName' => '_detailPorderDept',
			'labelDel' => 'Remove Row'
			//'cssFile' => 'css/jquery.appendo2.css'
	)); ?>
</div>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>