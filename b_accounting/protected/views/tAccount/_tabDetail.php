<!--
<h2>Parent Account</h2>
<?php 

$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				array(
						'label'=>'Parent Account',
						'type'=>'raw',
						'value'=> isset($model->getparent->account_name) ? CHtml::link($model->getparent->account_no .". ".$model->getparent->account_name,Yii::app()->createUrl('tAccount/view',array('id'=>$model->parent_id))) : "::root::",
				),
				'short_description',
		),
));
?>

<br />
-->
<h2>Account Properties</h2>

<?php
//$this->widget('bootstrap.widgets.BootDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,
		'data'=>array(
				'id'=>1, 'account_type'=>$model->getRoot(),
				'currency'=>$model->getCurrency(),
				'state'=>$model->getState(),
				'has_child'=>(isset($model->haschild)) ? $model->haschild->childName->name : "Not Set",
				'cash_bank'=>(isset($model->cashbank)) ? $model->cashbank->mtext : "Not Set",
				'hutang'=>(isset($model->hutang)) ? $model->hutang->setMvalue() : "Not Set",
				'inventory'=>(isset($model->inventory)) ? $model->inventory->setMvalue() : "Not Set",
		),
		'attributes'=>array(
				array('name'=>'account_type', 'label'=>'Account Type'),
				array('name'=>'currency', 'label'=>'Currency'),
				array('name'=>'state', 'label'=>'Status'),
				array('name'=>'has_child', 'label'=>'Has Child'),
				array('name'=>'cash_bank', 'label'=>'Cash Bank Account'),
				array('name'=>'hutang', 'label'=>'Payable Account'),
				array('name'=>'inventory', 'label'=>'Inventory Account'),
		),
)); ?>



<?php
if ($model->haschild->mvalue ==2) {
	?>

<hr />

<h3>Child Account</h3>
<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'t-account-grid',
		'dataProvider'=>tAccount::model()->search($model->id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array (
						'name'=>'account_no',
						'type'=>'raw',
						'value'=>'CHtml::link($data->account_concat(),Yii::app()->createUrl("tAccount/view",array("id"=>$data->id)))',
				),
				array(
						'name'=>'haschild_id',
						'value'=>'isset($data->haschild) ? $data->haschild->childName->name : "Not Set"',
				),
				array(
						'header'=>'Account Type',
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

<?php
}
?>

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
						'value'=>'CHtml::link($data->account_no. ". ".$data->account_name,Yii::app()->createUrl("tAccount/view",array("id"=>$data->id)))',
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

<?php
if ($model->haschild->mvalue ==2) {
	?>

<hr />

<h3>New Account</h3>
<?php echo $this->renderPartial('_form', array('model'=>$modelAccount)); ?>

<?php
}
?>




