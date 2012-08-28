<?php
$this->breadcrumbs=array(
		'Purchase Order',
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home', 'url'=>array('/m2/vPorderInventory/')),
		array('label'=>'Update', 'icon'=>'pencil','url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete', 'icon'=>'trash', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

$this->menu1=vPorder::getTopUpdated(1);
$this->menu2=vPorder::getTopCreated(1);
$this->menu5=array('PO');

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/shopcart.png') ?>
		PO:
		<?php echo $model->system_ref; ?>
	</h1>
</div>

<?php 
//$this->widget('bootstrap.widgets.BootDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,

		'data'=>$model,
		'attributes'=>array(
				'input_date',
				'periode_date',
				'system_ref',
				array(
						'label'=>'Purchasing Type',
						'value'=>$model->po_type->name,
				),
				'organization.name',
				array(
						'label'=>'Supplier',
						'value'=>$model->supplier->company_name,
				),
				'remark',
				array(
						'label'=>'Payment Status',
						'value'=>$model->paymentCheck(),
				),
				array(
						'label'=>'Total Amount',
						'value'=>Yii::app()->indoFormat->number($model->total_amount),
				),
		),
)); ?>

<?php 
//$this->widget('bootstrap.widgets.BootDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,

		'data'=>$model,
		'attributes'=>array(
				array(
						'label'=>'AF Date',
						'value'=>$model->po_ext->af_date,
				),
				null,
		),
)); ?>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'bporder-detail-grid',
		'dataProvider'=>vPorderDetail::model()->search($_GET['id']),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'header'=>'Item',
						'value'=>'$data->item_inventory->item_name',
				),
				'description',
				'qty',
				'uom',
				array(
						'value'=>'Yii::app()->indoFormat->number($data->amount)',
						'name'=>'amount',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Total',
						'value'=>'Yii::app()->indoFormat->number($data->amount)',
						'name'=>'amount',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
		),
));
?>
<br />
<b> Total: <?php echo Yii::app()->indoFormat->number($model->sum_po); ?>
</b>
