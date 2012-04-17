<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'csupplierap-grid',
		'dataProvider'=>bPorder::model()->searchSupplier($model->id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'header'=>'Entity',
						'value'=>'$data->organization->name',
				),
				'input_date',
				array(
					'header'=>'System Ref',
					'type'=>'raw',
					'value'=>'CHtml::link($data->system_ref,Yii::app()->createUrl("/mAccpayable/view",array("id"=>$data->id)))',
				),
				//'periode_date',
				//'remark',
				array(
						'header'=>'Total',
						'value'=>'$data->sum_pof()',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'class'=>'CButtonColumn',
						'template'=>'{myView}',
						'buttons'=>array
						(
								'myView' => array
								(
										'label'=>'<i class="icon-zoom-in"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/detail.png',
										'url'=>'$this->grid->controller->createUrl("viewSupplierDetail", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
										'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',
								),
						),

				),
				'approved_date',
				array(
						'header'=>'Payment',
						'value'=>'$data->payment',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Payment Status',
						'value'=>'$data->paymentCheck()',
				)
		),
));
?>

<br />
<?php 

//$this->widget('bootstrap.widgets.BootDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 3,
		'data'=>array(
			'id'=>1, 
			'countPO'=>bPorder::model()->count("supplier_id = ".$model->id), 
			'unApproved'=>bPorder::model()->count("approved_date is null AND supplier_id = ".$model->id), 
			'unPaid'=>bPorder::model()->count("approved_date is not null AND payment_state_id = 1 AND supplier_id = ".$model->id),
			'paid'=>bPorder::model()->count("payment_state_id = 2 AND supplier_id = ".$model->id),
			'amountPO'=>bPorder::model()->hutangPerSupplier($model->id),
			'payment'=>bPorder::model()->paymentPerSupplier($model->id),
			'balance'=>bPorder::model()->balancePerSupplier($model->id),
		),
		'attributes'=>array(
			array(
				'label'=>'Total Count PO',
				'name'=>'countPO', 
			),
			null,
			null,
			array(
				'label'=>'UnApproved',
				'name'=>'unApproved',
			),
			array(
				'label'=>'Unpaid',
				'name'=>'unPaid',
			),
			array(
				'label'=>'Paid',
				'name'=>'paid',
			),
			array(
				'label'=>'Total Amount PO',
				'name'=>'amountPO',
			),
			array(
				'label'=>'Total Payment',
				'name'=>'payment',
			),
			null,
			array(
				'label'=>'Balance',
				'name'=>'balance',
			),
		),
	)); 
?>


<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'cru-dialog',
		'options'=>array(
				'title'=>'View Detail',
				'autoOpen'=>false,
				'modal'=>true,
				'width'=>'70%',
				'height'=>'550',
		),
));
?>
<iframe id="cru-frame"
	width="100%" height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?>
