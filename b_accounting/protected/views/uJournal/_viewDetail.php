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
						'value'=>'CHtml::link($data->account->account_no.". ".$data->account->account_name,Yii::app()->createUrl("/tAccount/view",array("id"=>$data->account->id)))',
				),
				//'sub_account_id',
				array(
						'name'=>'debit',
						'value'=>'$data->debitf()',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array(
						'name'=>'credit',
						'value'=>'$data->creditf()',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
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
						'value'=>Yii::app()->numberFormatter->format("#,##0.00",uJournal::model()->findByPk((int)$id)->journalSum),
				),
				array(
						'label'=>'Check',
						'value'=>'WARNING!!! NOT BALANCE... CONTACT DEVELOPER',
						'visible'=>(uJournal::model()->findByPk((int)$id)->journalSum != uJournal::model()->findByPk((int)$id)->journalSumCek),
				),
		),
)); ?>
