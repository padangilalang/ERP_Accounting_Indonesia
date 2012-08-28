<?php
$this->breadcrumbs=array(
		'Purchase Order',
);

$this->menu=array(
		array('label'=>'Create PO Dept', 'url'=>array('createDept')),
		//array('label'=>'Create Simple PO', 'url'=>array('create')),
);

$this->menu1=aPorder::getTopUpdated();
$this->menu2=aPorder::getTopCreated();
$this->menu5=array('Simple PO');

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Purchase Order:
		<?php if ($id==1) echo "Pending"; elseif ($id==2) echo "UnPaid"; else ""; ?>
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'Waiting for Approval','url'=>Yii::app()->createUrl('/m1/aPorder',array("id"=>1)),'active'=>($id==1)),
				array('label'=>'Waiting for Payment','url'=>Yii::app()->createUrl('/m1/aPorder',array("id"=>2)),'active'=>($id==2)),
				array('label'=>'Paid','url'=>Yii::app()->createUrl('/m1/aPorder',array("id"=>3)),'active'=>($id==3)),
				array('label'=>'Show All','url'=>Yii::app()->createUrl('/m1/aPorder',array("id"=>0)),'active'=>($id==0)),
		),
));
?>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'aPorder-grid',
		'dataProvider'=>aPorder::model()->search($id),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{print}',
						'buttons'=>array
						(
								'print' => array
								(
										'label'=>'Print',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("/m1/aPorder/report1", array("id"=>$data->id))',
										'options'=>array(
												'class'=>'btn btn-mini',
										),
								),
						),

				),
				array(
						'header'=>'For Department',
						'value'=>'$data->organization->name',
						'visible'=>Yii::app()->user->name =="admin",
				),
				'input_date',
				array(
						'name'=>'no_ref',
						'type'=>'raw',
						'value'=>'CHtml::link($data->no_ref,Yii::app()->createUrl("/m1/aPorder/view",array("id"=>$data->id)))',
				),
				'periode_date',
				array(
						'header'=>'Main Category',
						'value'=>'$data->budgetcomp->getCodeName()',
				),
				//'remark',
//array(
				//	'header'=>'Paid By',
				//	'name'=>'issuer.name',
				//),
//'payment.name',
				array(
						'header'=>'Total',
						'value'=>'$data->sum_pof()',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				'approved_date',
				'payment_date',
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{myView}{myUpdate}',
						'buttons'=>array
						(
								'myView' => array
								(
										'label'=>'<i class="icon-zoom-in"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/detail.png',
										'url'=>'$this->grid->controller->createUrl("/m1/aPorder/view", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
										'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',
								),
								'myUpdate' => array
								(
										'label'=>'<i class="icon-pencil"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/edit.png',
										'url'=>'Yii::app()->createUrl("/m1/aPorder/update", array("id"=>$data->id))',
								),
						),

				),
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{delete}',
						'deleteButtonLabel'=>'<i class="icon-trash"></i>',
						'deleteButtonImageUrl'=>false,
						'visible'=>($id==1),
				),
		),
)); ?>

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
				'height'=>'500',
		),
));
?>
<iframe id="cru-frame" width="100%"
	height="100%"></iframe>
<?php

$this->endWidget();
//--------------------- end new code --------------------------
?><?php
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