<?php
$this->breadcrumbs=array(
		'Account Payable',
);

$this->menu=array(
		//array('label'=>'Create PO', 'url'=>array('create')),
);

$this->menu1=bPorder::getTopUpdated();
$this->menu2=bPorder::getTopCreated();
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/payment.png') ?>
		Account Payable:
		<?php if ($id==1) echo "Waiting for Approval"; elseif ($id==2) echo "Waiting for Payment"; elseif ($id==3) echo "Paid"; ?>
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'Waiting for Approval','url'=>Yii::app()->createUrl('/mAccpayable',array("id"=>1)),'active'=>($id==1)),
				array('label'=>'Waiting for Payment','url'=>Yii::app()->createUrl('/mAccpayable',array("id"=>2)),'active'=>($id==2)),
				array('label'=>'Paid','url'=>Yii::app()->createUrl('/mAccpayable',array("id"=>3)),'active'=>($id==3)),
				array('label'=>'Show All','url'=>Yii::app()->createUrl('/mAccpayable',array("id"=>0)),'active'=>($id==0)),
		),
));
?>


<?php 
if ($id ==2) {
	$form=$this->beginWidget('BootActiveForm', array(
			'id'=>'login-form',
			'action'=>array('mAccpayable/journalInventory'),
			'type'=>'inline',
			'enableAjaxValidation'=>true,
	));
} else {
	$form=$this->beginWidget('BootActiveForm', array(
			'id'=>'login-form',
			'action'=>array('mAccpayable/journalPayment'),
			'type'=>'inline',
			'enableAjaxValidation'=>true,
	));

}

?>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'bporder-grid',
		'dataProvider'=>bPorder::model()->searchAP($id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'selectableRows'=>null,
		'columns'=>array(
				array(
						'class'=>'CCheckBoxColumn',
						'name'=>'journal_id',
						'value'=>'$data->id',
						'id'=>'journal_id',
						'visible'=>($id ==2 || $id ==3),
						'selectableRows'=>($id ==3) ? 1 : 2,
				),
				array(
						'header'=>'Entity',
						'value'=>'$data->organization->name',
				),
				array(
						'header'=>'PO Type',
						'value'=>'$data->po_type->name',
				),
				array(
						'header'=>'Supplier',
						'type'=>'raw',
						'value'=>'CHtml::link($data->supplier->company_name,Yii::app()->createUrl("/mAccpayable/viewSupplier",array("id"=>$data->supplier_id)))',
				),
				'input_date',
				array(
						'name'=>'system_ref',
						'type'=>'raw',
						'value'=>'CHtml::link($data->system_ref,Yii::app()->createUrl("/mAccpayable/view",array("id"=>$data->id)))',
				),
				//'periode_date',
				//array(
				//	'header'=>'PO Type',
				//	'value'=>'$data->po_type_id',
				//),
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
						'template'=>'{myView}{print}',
						//'template'=>'{print}',
						'buttons'=>array
						(
								'myView' => array
								(
										'label'=>'<i class="icon-zoom-in"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/detail.png',
										'url'=>'$this->grid->controller->createUrl("/mAccpayable/view", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
										'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',
								),

								'print' => array
								(
										'label'=>'<i class="icon-print"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("bPorder/report1", array("id"=>$data->id))',
								),
						),

				),
				array(
						'header'=>'Take_Action',
						'class'=>'CButtonColumn',
						'template'=>'{approved}{payment}{paid}',
						'buttons'=>array
						(
								'approved' => array
								(
										'label'=>'Approval <i class="icon-forward"></i> ',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("/mAccpayable/setApproved", array("id"=>$data->id))',
										'visible'=>'!isset($data->approved_date)',
										'click'=>'
										function(){
										$.ajax({
										type : "get",
										url  : $(this).attr("href"),
										data: "",
										success : function(r){
}
})
										$.fn.yiiGridView.update("bporder-grid", {
										data: $(this).serialize()
});
										return false;
}
										',
								),
								'payment' => array
								(
										'label'=>'Payment <i class="icon-forward"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("/mAccpayable/view", array("id"=>$data->id))',
										'visible'=>'(isset($data->approved_date) && $data->payment_state_id ==1 && $data->journal_state_id ==2)',
								),
								'paid' => array
								(
										'label'=>'__PAID__',
										'visible'=>'isset($data->approved_date) && $data->payment_state_id ==2',
								),
						),

				),
				//'approved_date',
				array(
						'header'=>'Payment',
						'value'=>'$data->paymentf()',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Journal',
						'value'=>'$data->journal_state->name',
				),
		),
));

?>

<br />

<?php 
if ($id ==2) {
	echo CHtml::htmlButton('<i class="icon-ok"></i> Inventory Journal Processing ', array('class'=>'btn', 'type'=>'submit'));
} elseif ($id ==3) {
	echo CHtml::htmlButton('<i class="icon-ok"></i> Payment Journal Processing ', array('class'=>'btn', 'type'=>'submit'));
}


?>


<?php $this->endWidget(); ?>

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
<iframe id="cru-frame" width="100%"
	height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?>




