<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'abudget-grid',
		'dataProvider'=>aBudget::model()->search($id,$pro_id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		//'filter'=>$model,
		'columns'=>array(
				'year',
				'code',
				array (
						'name'=>'name',
						'type'=>'raw',
						//'value'=>'CHtml::ajaxLink($data->name,Yii::app()->createUrl("/m1/aBudget",array("id"=>$data->id,"pro_id"=>$data->department_id)),
						//array("update" => "#component"))',
						'value'=>'CHtml::link($data->name,Yii::app()->createUrl("/m1/aBudget",array("id"=>$data->id,"pro_id"=>$data->department_id)))',
				),
				array (
						'header'=>'Parent',
						'type'=>'raw',
						//'value'=>'($data->getparent) ? CHtml::ajaxLink($data->getparent->name,Yii::app()->createUrl("/m1/aBudget",array("id"=>$data->getparent->parent_id)),array("update" => "#component")) : ""',
						'value'=>'($data->getparent) ? CHtml::link($data->getparent->name,Yii::app()->createUrl("/m1/aBudget",array("id"=>$data->getparent->parent_id))) : ""',
				),
				//'unit',
				array(
						'name'=>'amount',
						//'value'=>'($data->childs) ? $data->sum_aff() : $data->amount',
						'value'=>'$data->amountf()',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Total AF (Approved)',
						'value'=>'$data->total_af',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Total AF (All)',
						'value'=>'$data->total_af_all',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Realization',
						'value'=>'($data->parent_id ==0) ? aBudget::model()->allComponent($data->id,2012) : aBudget::model()->allSubComponent($data->id,2012)',
						//'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Total Paid',
						'value'=>'($data->parent_id ==0) ? aBudget::model()->allComponentPaid($data->id,2012) : aBudget::model()->allSubComponentPaid($data->id,2012)',
						//'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Saldo',
						'value'=>'(isset($data->end_balance)) ? $data->end_balance->balancef() : ""',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'header'=>'Percentage',
						'value'=>'(isset($data->end_balance)) ? number_format($data->end_balance->balance / $data->amount * 100,2) : ""',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'class' => 'ext.BootProgressColumn',
						//'name' => 'percentage',
						//'value'=>'$data->amount',
						'percent' => 100,
						'value'=>'(isset($data->end_balance)) ? number_format($data->end_balance->balance / $data->amount * 100,2) : ""',
						'htmlOptions'=>array('style'=>'width: 100px;'),
				),
		),
)); ?>

<hr />

<?php
$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>array(
				'id'=>1,
				'total'=>aBudget::model()->getTotalComponent($id),
				'total_r'=>aBudget::model()->getTotalComponentR($id),
		),
		'attributes'=>array(
				array('name'=>'total', 'label'=>'Total Budget'),
				array('name'=>'total_r', 'label'=>'Total Realization'),
		),
)); ?>


<hr />

