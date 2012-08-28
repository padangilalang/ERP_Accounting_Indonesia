<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'u-journal-detail-grid',
		'dataProvider'=>uJournalDetail::model()->search($id),
		'template'=>'{items}{pager}',
		'itemsCssClass'=>'table table-striped table-bordered',
		'columns'=>array(
				array(
						'name'=>'account_no_id',
						'type'=>'raw',
						'value'=>'CHtml::link($data->account->account_no.". ".$data->account->account_name,Yii::app()->createUrl("/m2/tAccount/view",array("id"=>$data->account->id)))',
				),
				//'sub_account_id',
				array(
					  'class'=>'ext.gridcolumns.TotalColumn',
					  'name'=>'debit',
					  'output'=>'Yii::app()->indoFormat->number($value)',
					  'type'=>'raw',
					  'footer'=>true,
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
						'footerHtmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
					 ),
				array(
					'class'=>'ext.gridcolumns.TotalColumn',
					'name'=>'credit',
					'output'=>'Yii::app()->indoFormat->number($value)',
					'type'=>'raw',
					'footer'=>true,
					'htmlOptions'=>array(
							'style'=>'text-align: right; padding-right: 5px;'
					),
					'footerHtmlOptions'=>array(
							'style'=>'text-align: right; padding-right: 5px;'
					),
				),
				/* array(
					'class'=>'ext.gridcolumns.CalcColumn',
					'value'=>'$data->debit+$data->credit',
					'output'=>'Yii::app()->indoFormat->number($value)',
					'footerOutput'=>'Yii::app()->indoFormat->number($value)',
					'type'=>'raw',
					'footer'=>true,
					'htmlOptions'=>array(
							'style'=>'text-align: right; padding-right: 5px;'
					),
					'footerHtmlOptions'=>array(
							'style'=>'text-align: right; padding-right: 5px;'
					),
				),*/
				'user_remark',
				//'system_remark',
		),
)); ?>


<?php 

$this->widget('bootstrap.widgets.BootDetailView', array(
		'data'=>uJournal::model()->findByPk((int)$id),
		'attributes'=>array(
				array(
						'label'=>'Total',
						'value'=>Yii::app()->indoFormat->number(uJournal::model()->findByPk((int)$id)->journalSum),
				),
				array(
						'label'=>'Check',
						'value'=>'WARNING!!! NOT BALANCE... CONTACT DEVELOPER',
						'visible'=>(uJournal::model()->findByPk((int)$id)->journalSum != uJournal::model()->findByPk((int)$id)->journalSumCek),
				),
		),
)); 

?>
