<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/js/jquery-ui-1.8.16.custom.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->getClientScript()->getCoreScriptUrl().'/jui/css/2jui-bootstrap/jquery-ui.css');
Yii::app()->getClientScript()->registerCoreScript('maskedinput');

Yii::app()->clientScript->registerScript('datepicker', "
	$(function() {
		$( \"#".CHtml::activeId($model,'input_date')."\" ).datepicker({
		'dateFormat' : 'dd-mm-yy',
		});
		$( \"#".CHtml::activeId($model,'periode_date')."\" ).datepicker({
			'dateFormat':'yymm',
		});
		$( \"#".CHtml::activeId($model,'input_date')."\" ).mask('99-99-9999');
		$( \"#".CHtml::activeId($model,'periode_date')."\" ).mask('999999');
	});

");
?>

<?php
$this->breadcrumbs=array(
		'Purchase Order with Dept'=>array('index'),
		'Create',
);$this->menu=array(
		array('label'=>'Home', 'url'=>array('/m1/aPorder07')),
		array('label'=>'Create Simple PO', 'url'=>array('create')),
);

$this->menu1=aPorder::getTopUpdated07();
$this->menu2=aPorder::getTopCreated07();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Create New PO C-07 with Dept
	</h1>
</div>

<div class="btn-group">
	<a class="btn"
		href="<?php echo Yii::app()->createUrl('/m1/aPorder07/create') ?>">Create
		PO</a> <a class="btn"
		href="<?php echo Yii::app()->createUrl('/m1/aPorder07/createDept') ?>">Create
		PO With Dept</a> <a class="btn"
		href="<?php echo Yii::app()->createUrl('/m1/aPorder07/create') ?>">Create
		Non PO</a>
</div>
<br />

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	
		'id'=>'aPorder-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'input_date'); ?>

<?php echo $form->textFieldRow($model,'no_ref',array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model,'periode_date'); ?>

<?php echo $form->dropDownListRow($model,'budgetcomp_id',aBudget::mainComponent()); ?>


<?php echo $form->textAreaRow($model,'remark',array('rows'=>2, 'cols'=>50)); ?>


<?php echo $form->dropDownListRow($model,'issuer_id',sParameter::items("cIssuer")); ?>
<?php $this->widget('ext.appendo.JAppendo',array(
		'id' => 'repeateEnum',
		'model' => $model,
		'viewName' => '_detailPorderDept',
		'labelDel' => 'Remove Row'
		//'cssFile' => 'css/jquery.appendo2.css'
)); ?>
<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>
