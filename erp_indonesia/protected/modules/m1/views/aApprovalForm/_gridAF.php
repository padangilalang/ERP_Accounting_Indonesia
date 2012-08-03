
<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'aPorder-grid',
		'dataProvider'=>aPorder::model()->approvalForm($id,$cid),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'class'=>'CButtonColumn',
						'template'=>'{approved}{payment}',
						'buttons'=>array
						(
								'approved' => array
								(
										'label'=>'Approved',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("/m1/aApprovalForm/updateApproved", array("id"=>$data->id))',
										'visible'=>'(!isset($data->approved_date))',
										'options'=>array(
												'class'=>'btn btn-mini',
												'ajax'=>array(
														'type'=>'GET',
														'url'=>"js:$(this).attr('href')",
														'success'=>'js:function(data){$("#mydialog").dialog("open");
														$.fn.yiiGridView.update("aPorder-grid", {
														data: $(this).serialize()
});
}',
												),
										),
								),
								'payment' => array
								(
										'label'=>'Paid',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("/m1/aApprovalForm/updatePaid", array("id"=>$data->id))',
										'visible'=>'(isset($data->approved_date)) && (!isset($data->payment_date))',
										'options'=>array(
												'class'=>'btn btn-mini',
												'ajax'=>array(
														'type'=>'GET',
														'url'=>"js:$(this).attr('href')",
														'success'=>'js:function(data){$("#mydialog").dialog("open");
														$.fn.yiiGridView.update("aPorder-grid", {
														data: $(this).serialize()
});
}',
												),
										),
								),
						),

				),
				array(
						'class'=>'CButtonColumn',
						'template'=>'{print}',
						'buttons'=>array
						(
								'print' => array
								(
										'label'=>'Print AF ',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("/m1/aApprovalForm/report1", array("id"=>$data->id))',
										'visible'=>'(!isset($data->approved_date))',
										'options'=>array(
												'class'=>'btn btn-mini',
										),
								),
						),

				),
				array(
						'class'=>'CButtonColumn',
						'template'=>'{budgetposition}',
						'buttons'=>array
						(
								'budgetposition' => array
								(
										'label'=>' Budget Position',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'Yii::app()->createUrl("/m1/aApprovalForm/report2", array("id"=>$data->id))',
										'visible'=>'(!isset($data->approved_date))',
										'options'=>array(
												'class'=>'btn btn-mini',
										),
								),
						),

				),
				array(
						'header'=>'Budget Project',
						'name'=>'organization.getparent.getparent.name',
				),
				'input_date',
				//'no_ref',
				array(
						'name'=>'no_ref',
						'type'=>'raw',
						'value'=>'CHtml::link($data->no_ref,Yii::app()->createUrl("/m1/aApprovalForm/view",array("id"=>$data->id)))',
				),
				'periode_date',
				array(
						'header'=>'BudgetComp',
						//'value'=>'$data->budgetcomp_id',
						'value'=>'isset($data->budgetcomp) ? $data->budgetcomp->name : "!!!ERROR CONTACT PETER!!!"',
						//'visible'=>(!isset($_GET["cid"])),
				),
				'remark',
				//'issuer.name',
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
										'url'=>'$this->grid->controller->createUrl("/m1/aApprovalForm/view", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
										'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open"); return false;}',				),
						),

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
				'height'=>'400',
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
				'title'=>'Process',
				'autoOpen'=>false,
				'modal'=>true,
		),
));
echo 'Process Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
