<?php $form=$this->beginWidget('BootActiveForm', array(
		'id'=>'t-account-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model,'haschild_id',sParameter::items("cHasChild"),array(
		'disabled'=>!empty($model->hasJournal),
		'hint'=>'Dropdown will disabled automatically when this account already has journal voucher on current period',
)); ?>
<?php echo $form->textFieldRow($model,'account_no',array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'account_name',array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model,'short_description',array('class'=>'span5','rows'=>3)); ?>
<?php //echo $form->dropDownListRow($model,'currency_id',sParameter::items("cCurrency","*inherited*")); ?>
<?php //echo $form->dropDownListRow($model,'state_id',sParameter::items("cStatus","*inherited*")); ?>

<?php $this->widget('ext.appendo2.JAppendo',array(
		'id' => 'repeateEnum',
		'model' => $model,
		'viewName' => '_accountProperties',
		'labelDel' => 'Remove Row'
		//'cssFile' => 'css/jquery.appendo2.css'
)); ?>

<div class="form-actions">
	<?php echo CHtml::htmlButton('<i class="icon-ok"></i>'.$model->isNewRecord ? 'Create':'Save', array('class'=>'btn', 'type'=>'submit')); ?>
</div>

<?php $this->endWidget(); ?>

<hr />

<h3>Sibling Account</h3>
<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'t-account-grid',
		'dataProvider'=>tAccount::model()->searchSibling($model->parent_id,$model->id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array (
						'name'=>'account_no',
						'type'=>'raw',
						'value'=>'CHtml::link($data->account_no. ". ".$data->account_name,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->id)))',
				),
				array(
						'name'=>'haschild_id',
						'value'=>'isset($data->haschild) ? $data->haschild->childName->name : "Not Set"',
				),
				array(
						'header'=>'Type Account',
						'value'=>'$data->getRoot()',
				),
				array(
						'header'=>'Currency',
						'value'=>'$data->getCurrency()',
				),
				array (
						'header'=>'Status',
						'value'=>'$data->getState()',
				),
		),
));

?>
