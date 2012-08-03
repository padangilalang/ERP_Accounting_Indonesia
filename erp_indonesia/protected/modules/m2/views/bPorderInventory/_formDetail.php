<?php $this->widget('BootGridView', array(
	'id'=>'b-porder-detail-grid',
	'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'template'=>'{items}',
	'columns'=>array(
		array(
			'header'=>'Item',
			'value'=>'CProduct::model()->findByPk($data["item_id"])->item',
		),
		'description',
		'qty',
		'amount',
		//array(
		//	'header'=>'Delete',
		//	'type'=>'raw',
		//	'value'=>'CHtml::link("Delete",Yii::app()->createUrl("/m2/bPorderInventory/DeleteTempById",array("id"=>$data["id"])))',
		//),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{myDelete}',
			'buttons'=>array
			(
				'myDelete' => array
				(
					'label'=>'Delete',
					'url'=>'Yii::app()->createUrl("/m2/bPorderInventory/DeleteTempById",array("id"=>$data["id"]))',
					'options'=>array(
						'ajax'=>array(
							'type'=>'GET',
							'url'=>"js:$(this).attr('href')",
							'success'=>'js:function(data){
								$.fn.yiiGridView.update("b-porder-detail-grid", {
									data: $(this).serialize()
								});
							}',
						),
					),
				),
			),
		),
		
		
		//array(
		//	'class'=>'CButtonColumn',
			//'template'=>'{delete}',
		//),
	),
)); ?>
