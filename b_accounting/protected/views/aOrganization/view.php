<?php
if ($model->structure_id ==3) {
	$this->breadcrumbs=array(
			$model->getparent->getparent->name=>array('view','id'=>$model->getparent->getparent->id),
			$model->getparent->name=>array('view','id'=>$model->getparent->id),
			$model->name,
	);

} elseif ($model->structure_id ==2) {
	$this->breadcrumbs=array(
			$model->getparent->name=>array('view','id'=>$model->getparent->id),
			$model->name,
	);
} else {
	$this->breadcrumbs=array(
			$model->name,
	);
}

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/aOrganization')),
		array('label'=>'Create', 'url'=>array('create')),
		array('label'=>'Update', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

$this->menu1=aOrganization::getTopUpdated();
$this->menu2=aOrganization::getTopCreated();
$this->menu3=aOrganization::getTopRelated($model->id);

?>

<div class="page-header">
	<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/document_organization_chart_01.png') ?>
		<?php echo $model->name; ?>
	</h1>
</div>


<?php 
//$this->widget('bootstrap.widgets.BootDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,

		'data'=>$model,
		'attributes'=>array(
				'branch_code',
				'name',
				'address',
				'address2',
				'address3',
				'address4',
				/*		array (
				 'label'=>'Kab/Kodya',
						'value'=>sKabupatenPropinsi::model()->findByNull((int)$model->kabupaten_id),
				),
array (
		'label'=>'Propinsi',
		'value'=>sKabupatenPropinsi::model()->findByNull((int)$model->propinsi_id),
),
*/		'pos_code',
				'phone_code_area',
				'telephone',
				'fax',
				'email',
				'website',
		),
)); ?>

<h2>Account Behalf of This Entity</h2>
<?php $this->widget('bootstrap.widgets.BootGridView', array(

		'id'=>'t-account-grid',
		'dataProvider'=>tAccountEntity::model()->searchEntity($model->id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
					'header'=>'Account',
					'type'=>'raw',
					'value'=>'CHtml::link($data->account->account_concat(),Yii::app()->createUrl("/tAccount/view",array("id"=>$data->parent_id)))',
				),
				array(
						'header'=>'Type Account',
						'name'=>'haschild_id',
						'value'=>'$data->account->getRoot()',
				),
				array(
						'header'=>'Currency',
						'name'=>'currency_id',
						'value'=>'$data->account->getCurrency()',
				),
				array (
						'header'=>'Status',
						'name'=>'state_id',
						'value'=>'$data->account->getState()',
				),
		),
)); ?>
