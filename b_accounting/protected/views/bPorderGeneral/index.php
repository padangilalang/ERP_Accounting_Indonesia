<?php
$this->breadcrumbs=array(
		'Purchase Order',
);

$this->menu=array(
		array('label'=>'Create PO General', 'url'=>array('create')),
		array('label'=>'Home PO Inventory', 'url'=>array('/bPorderInventory')),
);

$this->menu1=bPorder::getTopUpdated(2);
$this->menu2=bPorder::getTopCreated(2);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/shopcart.png') ?>
		PO General:
		<?php if ($id==1) echo "UnApproved"; elseif ($id==2) echo "Unpaid/Partial Paid"; else "Paid"; ?>
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'UnApproved','url'=>Yii::app()->createUrl('/bPorderGeneral',array("id"=>1)),'active'=>($id==1)),
				array('label'=>'UnPaid/Partial Paid','url'=>Yii::app()->createUrl('/bPorderGeneral',array("id"=>2)),'active'=>($id==2)),
				array('label'=>'Paid','url'=>Yii::app()->createUrl('/bPorderGeneral',array("id"=>3)),'active'=>($id==3)),
				array('label'=>'Show All','url'=>Yii::app()->createUrl('/bPorderGeneral',array("id"=>0)),'active'=>($id==0)),
		),
));
?>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'bPorderStock-grid',
		'dataProvider'=>bPorder::model()->searchGeneral($id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'header'=>'Entity',
						'value'=>'$data->organization->name',
				),
				array(
						'header'=>'Budget Comp',
						'value'=>'$data->budgetcomp->account_concat()',
				),
				array(
						'header'=>'Supplier',
						'value'=>'$data->supplier->company_name',
				),
				'input_date',
				array(
						'header'=>'System Ref',
						'type'=>'raw',
						'value'=>'CHtml::link($data->system_ref,Yii::app()->createUrl("/bPorderGeneral/view",array("id"=>$data->id)))',
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
						'template'=>'{myUpdate}{myDelete}{myView}',
						'buttons'=>array
						(
								'myUpdate' => array
								(
										'label'=>'<i class="icon-pencil"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/update.png',
										'url'=>'$this->grid->controller->createUrl("/bPorderInventory/update", array("id"=>$data->id))',
										'visible'=>'!isset($data->approved_date)',
								),
								'myDelete' => array
								(
										'label'=>'<i class="icon-remove"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/delete.png',
										'url'=>'$this->grid->controller->createUrl("/bPorderInventory/delete", array("id"=>$data->id))',
										'visible'=>'!isset($data->approved_date)',
								),
								'myView' => array
								(
										'label'=>'<i class="icon-zoom-in"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/detail.png',
										'url'=>'$this->grid->controller->createUrl("/bPorderInventory/view", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
										'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',
								),
						),

				),
				'approved_date',
				array(
						'header'=>'Payment Status',
						'value'=>'$data->paymentCheck()',
				)
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
<iframe id="cru-frame" width="100%"
	height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'mydialog',
		'options'=>array(
				'title'=>'Payment Process',
				'autoOpen'=>false,
				'modal'=>true,
		),
));
echo 'Posting Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>