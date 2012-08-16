<?php
$this->breadcrumbs=array(
		'Supplier',
);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/lorrygreen.png') ?>
		Data Supplier
	</h1>
</div>

<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'p-product-grid',
		'dataProvider'=>cSupplier::model()->search(),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'name'=>'company_name',
						'type'=>'raw',
						'value'=>'CHtml::link($data->company_name,Yii::app()->createUrl("/m2/mAccpayable/viewSupplier",array("id"=>$data->id)))',
				),
				'pic',
				'address',
				'city',
				'status_id',
				array (
						'header'=>'Total PO',
						'value'=>'vPorder::model()->count("supplier_id = ".$data->id)',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'header'=>'Amount',
						'value'=>'vPorder::model()->hutangPerSupplier($data->id)',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'header'=>'Payment',
						'value'=>'vPorder::model()->paymentPerSupplier($data->id)',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'header'=>'Balance',
						'value'=>'vPorder::model()->balancePerSupplier($data->id)',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),

		),
)); ?>
