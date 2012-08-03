<?php if ($id ==300 || ($id !=null && aBudget::model()->findByPk((int)$id)->parent_id ==300 )) {

	echo "<h2>List of AF</h2>";

	$this->widget('bootstrap.widgets.BootGridView', array(
			'id'=>'aPorder-grid',
			'dataProvider'=>aPorder::model()->approvalForm(0,$id),
			//'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'template'=>'{items}{pager}',
			'columns'=>array(
					'input_date',
					array(
							'name'=>'no_ref',
							'type'=>'raw',
							'value'=>'CHtml::link($data->no_ref,Yii::app()->createUrl("/m1/aPorder/view",array("id"=>$data->id)))',
					),
					'periode_date',
					'remark',
					//'issuer.name',
					array(
							'header'=>'Total',
							'value'=>'$data->sum_pof()',
							'htmlOptions'=>array(
									'style'=>'text-align: right; padding-right: 5px;'
							),
					),
					'approved_date',
					'payment_date',
			),
	));



}
?>
