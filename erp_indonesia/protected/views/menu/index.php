<?php /*
$this->beginWidget('application.extensions.messagecenter.EMessageCenter');
echo "";
$this->endWidget('application.extensions.messagecenter.EMessageCenter'); */
?>
	<div class="well">
		<?php echo $this->renderPartial("_tabPersonal", array("model"=>$model,"dataProvider"=>$dataProvider),true) ?>
	</div>
	<?php /*	
		<?php echo $this->renderPartial("_tabSystem", array("model3"=>$model3,"dataProvider"=>$dataProvider3),true) ?>
	*/ ?>

	<div class="well">
		<?php echo $this->renderPartial("_tabReminder", array("model"=>$model,"modeltask"=>$modeltask),true) ?>
	</div>

		<?php 
			$this->Widget('ext.highcharts.HighchartsWidget', array(
			   'options'=>array(
				  'title' => array('text' => 'Fruit Consumption'),
				  'xAxis' => array(
					 'categories' => array('Apples', 'Bananas', 'Oranges')
				  ),
				  'yAxis' => array(
					 'title' => array('text' => 'Fruit eaten')
				  ),
				  'series' => array(
					 array('name' => 'Jane', 'data' => array(1, 0, 4)),
					 array('name' => 'John', 'data' => array(5, 7, 3))
				  )
			   )
			));		
		?>

