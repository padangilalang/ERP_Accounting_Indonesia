<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'mydialog',
		'options'=>array(
				'title'=>'Posting',
				'autoOpen'=>false,
				'modal'=>true,
		),
));
echo 'Posting Complete...';
$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

<h2>Balance Sheet</h2>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'t-account-balance-sum-grid',
		'dataProvider'=>tBalanceSheet::model()->search($model->id),
		'template'=>'{items}{pager}',
		'itemsCssClass'=>'table table-striped table-bordered',
		'columns'=>array(
				array(
						'name'=>'type_balance_id',
						'value'=>'sParameter::item("cBalanceType",$data->type_balance_id)',
				),
				'yearmonth_periode',
				//array(
				//	'name'=>'budget',
				//	'htmlOptions'=>array(
				//		'style'=>'text-align: right; padding-right: 5px;'
				//	),
				//),
				array(
						'name'=>'beginning_balance',
						'value'=>'$data->beginf()',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
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
				array(
						'name'=>'end_balance',
						'value'=>'$data->endf()',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
		),
)); ?>

<br>

<h2>
	Current Period Journal List:
	<?php echo Yii::app()->settings->get("System", "cCurrentPeriod") ?>
</h2>

<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
//$this->widget('ext.groupgridview.GroupGridView', array(
//		'mergeColumns' => array('journal.input_date'),
		'id'=>'t-account-balance-grid',
		'dataProvider'=>uJournalDetail::model()->searchByAccount($model->id),
		'template'=>'{items}{pager}{summary}',
		'itemsCssClass'=>'table table-striped table-bordered',
		'columns'=>array(
				array(
						'class'=>'CButtonColumn',
						'template'=>'{post}',
						'buttons'=>array
						(
								'post' => array
								(
										'label'=>'<i class="icon-ok-sign"></i> Post',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/process.png',
										'url'=>'
										Yii::app()->createUrl("/m2/tPosting/posting",
										array("id"=>$data->journal->id))
										',
										'visible'=>'$data->journal->state_id ==1 || $data->journal->state_id ==2',
										'click'=>'
										function(){
										$.ajax({
										type : "get",
										url  : $(this).attr("href"),
										data: "",
										success : function(r){
										$("#mydialog").dialog("open");
										setTimeout(\'$("#mydialog").dialog("close") \',1200);

}
})
										$.fn.yiiGridView.update("t-account-balance-grid", {
										data: $(this).serialize()
});
										$.fn.yiiGridView.update("t-account-balance-sum-grid", {
										data: $(this).serialize()
});
										return false;
}
										',

								),
						),
				),
				array(
						'header'=>'Tanggal',
						'name'=>'journal.input_date',
						'value'=>'$data->journal->input_date',
				),
				array(
						'header'=>'Entity',
						'value'=>'$data->journal->entity->name',
				),
				array(
						'header'=>'No Ref',
						'value'=>'$data->journal->system_reff()',
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
				array(
						'class'=>'CButtonColumn',
						'template'=>'{detail}',
						'buttons'=>array
						(
								'detail' => array
								(
										'label'=>'<i class="icon-zoom-in"></i>',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/detail.png',
										'url'=>'
										Yii::app()->createUrl("/m2/tAccount/viewJournal",
										array("id"=>$data->journal->id,"asDialog"=>1,"gridId"=>$this->grid->id))
										',

										'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;} ',

								),
						),
				),

		/*				array(
		 'header'=>'Test',
				'value'=>'$data->journal->entity->getTopLevelId()',
		),
		array(
				'header'=>'Test',
				'value'=>'sUser::model()->getGroup()',
		),
		*/
		),
));
?>

<br />

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
/*$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#t-account-balance-grid table',
    'itemSelector' => 'tr',
    'loadingText' => 'Loading...',
    'donetext' => 'This is the end... ',
    'pages' => $pages,
)); 
*/
?>
