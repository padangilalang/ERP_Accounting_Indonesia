<?php
$this->breadcrumbs=array(
		'Purchase Order with Dept'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/m1/aApprovalForm')),
);

$this->menu1=aPorder::getTopUpdated();
$this->menu2=aPorder::getTopCreated();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/payment.png') ?>
		Approval Form
	</h1>
</div>

<?php 
//----- begin new code --------------------
if (empty($_GET['asDialog'])) {
	//$this->widget('bootstrap.widgets.BootDetailView', array(
	$this->widget('ext.XDetailView', array(
			'ItemColumns' => 2,

			'data'=>$model,
			'attributes'=>array(
					array(
							'label'=>'Entity',
							'value'=>$model->organization->name,
					),
					'input_date',
					'af_date',
					'no_ref',
					'periode_date',
					array(
							'label'=>'Budget Component',
							'value'=>$model->budgetcomp->name,
					),
					'approved_date',
					'remark',
					array(
							'label'=>'Issued By',
							'value'=>$model->issuer->name,
					),
					array(
							'label'=>'Payment Status',
							'value'=>$model->payment->name,
					),
					'payment_date',
			),
	));
}
//----- end new code --------------------

?>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'aPorder-detail-grid',
		'dataProvider'=>aPorderDetail::model()->search($_GET['id']),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		//'filter'=>$model,
		'columns'=>array(
				array(
						'class'=>'CButtonColumn',
						'template'=>'{payment}',
						'buttons'=>array
						(
								'payment' => array
								(
										'label'=>'Paid',
										'url'=>'Yii::app()->createUrl("/m1/aApprovalForm/updateDetailPaid", array("id"=>$data->id))',
										'visible'=>'$data->detail_payment_id ==1',
										'options'=>array(
												'ajax'=>array(
														'type'=>'GET',
														'url'=>"js:$(this).attr('href')",
														'success'=>'js:function(data){
														$.fn.yiiGridView.update("aPorder-detail-grid", {
														data: $(this).serialize()
});
}',
												),
										),
								),
						),

				),
				array(
						'header'=>'Department',
						'value'=>'isset($data->department) ? $data->department->name : "ALL"',
				),
				array(
						'header'=>'Budget SubComp.',
						'value'=>'$data->budget->code .". ".$data->budget->name',
				),
				//'supplier.company_name',
				'description',
				//'user',
				//'qty',
				//'uom',
				array(
						'value'=>'$data->amountf()',
						'name'=>'amount',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Total',
						'value'=>'$data->totalf()',
						'name'=>'amount',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Payment',
						'value'=>'$data->payment->name',
				),
		),
)); ?>
<br />
<b> Total: <?php echo $model->sum_pof(); ?>
</b>
