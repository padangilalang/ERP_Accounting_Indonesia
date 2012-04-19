<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'u-journal-detail-grid',
		'dataProvider'=>uJournalDetail::model()->search($id),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'name'=>'account_no_id',
						'type'=>'raw',
						'value'=>'CHtml::link($data->account->account_no.". ".$data->account->account_name,Yii::app()->createUrl("/tAccount/view",array("id"=>$data->account->id)))',
				),
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
		),
)); ?>

<?php
if ($data->state_id ==1 || $data->state_id ==2) {
	$this->widget('zii.widgets.jui.CJuiButton', array(
			'buttonType'=>'link',
			'id'=>'myCap'.$id,
			'name'=>'btnGo'.$id,
			'url'=>Yii::app()->createUrl("/tPosting/posting",array("id"=>$id)),
			'caption'=>($data->state_id == 1) ? 'Post' : 'Re-Post',
			'options'=>array(
					//'icons'=>'js:{secondary:"ui-icon-extlink"}',
			),
			'htmlOptions'=>array(
					'class'=>'ui-button-primary',
			),

	));
} elseif ($data->state_id ==4) {
	$this->widget('zii.widgets.jui.CJuiButton', array(
			'buttonType'=>'link',
			'id'=>'myCap'.$id,
			'name'=>'btnGo'.$id,
			'url'=>Yii::app()->createUrl("/tPosting/unposting",array("id"=>$id)),
			'caption'=>'Un-Post',
			'options'=>array(
					//'icons'=>'js:{secondary:"ui-icon-extlink"}',
			),
			'htmlOptions'=>array(
					'class'=>'ui-button-primary',
			),

	));
} else {
	$this->widget('zii.widgets.jui.CJuiButton', array(
			'buttonType'=>'link',
			'id'=>'myCap'.$id,
			'name'=>'btnGo'.$id,
			'url'=>Yii::app()->createUrl("/tPosting/unlock",array("id"=>$id)),
			'caption'=>'Un-Lock',
			'options'=>array(
					//'icons'=>'js:{secondary:"ui-icon-extlink"}',
			),

	));
}
?>
<hr />
