<?php
$this->breadcrumbs=array(
		'Purchase Order with Dept'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/m1/aPorder')),
		array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
);

$this->menu1=aPorder::getTopUpdated();
$this->menu2=aPorder::getTopCreated();

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		<?php echo "PO: ".$model->no_ref; ?>
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
						'template'=>'{my_delete}',
						'buttons'=>array(
								'my_delete' => array
								(
										'label'=>'<i class="icon-trash"></i',
										'url'=>'Yii::app()->createUrl("/m1/aPorder/deleteDetail", array("id"=>$data->id))',
										'visible'=>'$data->po->approved_date == null',
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
		),
)); ?>
<br />
<b> Total: <?php echo $model->sum_pof(); ?>
</b>
