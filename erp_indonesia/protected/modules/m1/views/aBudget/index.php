<?php
$this->breadcrumbs=array(
		'Budget',
);$this->menu=array(
		array('label'=>'Create', 'url'=>array('create')),
);
?>

<div class="pull-right">
	<div class="span2">

		<?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
				'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
				'buttons'=>array(
						array('label'=>'Project', 'items'=>array(
								array('label'=>'C-06 CP', 'url'=>Yii::app()->createUrl("/m1/aBudget")),
								array('label'=>'C-06 RMG/ MGR', 'url'=>Yii::app()->createUrl("/m1/aBudget/index",array("id"=>300,"pro_id"=>2))),
								'---',
								array('label'=>'C-07 CP', 'url'=>Yii::app()->createUrl("/m1/aBudget/index",array("id"=>1001))),
						)),
				),
		)); ?>

	</div>


	<div class="span4">
		<?php	$this->widget('bootstrap.widgets.BootButtonGroup', array(
				'buttons'=>array(
						array('label'=>'Budget Position', 'url'=>Yii::app()->createUrl("/m1/aBudget/report1",array("id"=>$id,"pro_id"=>$pro_id))),
						array('label'=>'Budget Position Summary', 'url'=>Yii::app()->createUrl("/m1/aBudget/report2",array("id"=>$id,"pro_id"=>$pro_id))),
				),

		));
		?>
	</div>

</div>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/balance.png') ?>
		Budget:
		<?php echo ($pro_id ==2) ? "RMG / MGR" : "CP" ?>
		<?php //echo ($id !=null or $id !=0) ? '| '.aBudget::model()->findByPk($id)->name : '' ?>
	</h1>
</div>


<br />

<?php if ($id == 0 || aBudget::model()->findByPk((int)$id)->childs) { 
	?>
<div id="component">
	<?php	
	echo $this->renderPartial('_component', array('id'=>$id,'pro_id'=>$pro_id));
	?>
</div>
<?php	
echo $this->renderPartial('_listAF', array('id'=>$id));
?>

<br />
<?php /**/
$this->Widget('ext.highcharts.HighchartsWidget', array(
		'options'=>array(
				'chart' => array('defaultSeriesType' => 'column'),
				'theme' => 'grid',
				'title' => array('text' => 'Budget'),
				'xAxis' => array(
						'categories' => aBudget::model()->perBudgetModelCat($id,$pro_id)
				),
				'yAxis' => array(
						'title' => array('text' => 'Rupiah'),
				),
				'series'=>aBudget::model()->perBudgetModel($id,$pro_id),
		),
));
/**/
?>

<?php
} else {
	echo $this->renderPartial('_detail', array('id'=>$id));
}
?>
