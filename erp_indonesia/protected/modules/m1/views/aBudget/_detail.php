<?php
//echo CHtml::link("Back to Parent",Yii::app()->createUrl("/m1/aBudget",array("id"=>aBudget::model()->findByPk((int)$id)->getparent->id)));


$this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'a-porder-grid',
		'dataProvider'=>aBudget::model()->perBulan($id),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				'code',
				'name',
				array (
						'name'=>'amount',
						'header'=>'Total Budget',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201201',
						'header'=>'2012 01',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201202',
						'header'=>'2012 02',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201203',
						'header'=>'2012 03',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201204',
						'header'=>'2012 04',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201205',
						'header'=>'2012 05',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201206',
						'header'=>'2012 06',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201207',
						'header'=>'2012 07',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201208',
						'header'=>'2012 08',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201209',
						'header'=>'2012 09',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201210',
						'header'=>'2012 10',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201211',
						'header'=>'2012 11',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201212',
						'header'=>'2012 12',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
		),
));

?>
<br />
<?php
$this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'a-porder-grid',
		'dataProvider'=>aBudget::model()->perBulanDept($id),
		'template'=>'{items}',
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				'department',
				//'name',
				array (
						'name'=>'amount',
						'header'=>'Total Budget',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201201',
						'header'=>'2012 01',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201202',
						'header'=>'2012 02',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201203',
						'header'=>'2012 03',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201204',
						'header'=>'2012 04',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201205',
						'header'=>'2012 05',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201206',
						'header'=>'2012 06',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201207',
						'header'=>'2012 07',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201208',
						'header'=>'2012 08',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201209',
						'header'=>'2012 09',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201210',
						'header'=>'2012 10',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201211',
						'header'=>'2012 11',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
				array (
						'name'=>'201212',
						'header'=>'2012 12',
						'type'=>'number',
						'htmlOptions'=>array(
								'style'=>'text-align: right; padding-right: 5px;'
						),
				),
		),
));

?>
<hr />
<br />
<?php 
if (aBudget::model()->perBulanModel($id) !=null) {
	$this->Widget('ext.highcharts.HighchartsWidget', array(
			'options'=>array(
				 'chart' => array('defaultSeriesType' => 'column'),
				 'theme' => 'grid',
				 'title' => array('text' => 'Pertumbuhan By Component'),
				 'xAxis' => array(
				 		'categories' => array('Jan', 'Feb', 'Mar','Apr', 'May', 'Jun','Jul', 'Aug', 'Sept','Oct', 'Nov', 'Des', )
				 ),
				 'yAxis' => array(
				 		'title' => array('text' => 'Jumlah ( x 100.000)'),
				 ),
				 'series'=>aBudget::model()->perBulanModel($id),
			),
	));
}
?>
