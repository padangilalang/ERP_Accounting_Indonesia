<?php
$this->breadcrumbs=array(
		'Purchase Order with Dept'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/m1/m1/aPorder')),
		array('label'=>'Create Simple PO', 'url'=>array('create')),
);

$this->menu1=aPorder::getTopUpdated();
$this->menu2=aPorder::getTopCreated();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Create New PO with Dept
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

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(	'id'=>'aPorder-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
)); ?>
<div class="control-group">
	<?php echo $form->labelEx($model,'input_date',array("class"=>"control-label")); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'value'=>cTimestamp::formatDate('yyyy-MM-dd',$model->input_date),
				'attribute'=>'input_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(

				)
		));
		?>
	</div>
</div>

<?php echo $form->textFieldRow($model,'no_ref',array('class'=>'span3')); ?>

<div class="control-group">
	<?php echo $form->labelEx($model,'periode_date',array("class"=>"control-label")); ?>
	<div class="controls">
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'id'=>'balance-begin1',
				'value'=>cTimestamp::formatDate('yyyy-MM-dd',$model->periode_date),
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

<?php
$this->widget('zii.widgets.jui.CJuiButton', array(
		'buttonType'=>'submit',
		'name'=>'btnGo7',
		'caption'=>$model->isNewRecord ? 'Create':'Save',
		'options'=>array('icons'=>'js:{secondary:"ui-icon-extlink"}'),
));
?>
<?php $this->endWidget(); ?>