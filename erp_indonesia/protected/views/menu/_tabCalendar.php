<?php
$this->widget('application.extensions.fullcalendar.FullcalendarGraphWidget',
		array(
		'data' => array(
			array(
				'title' => 'My First Appointment',
				'start' => '2012-07-04',
				'color'=>'#000000',
			),
			array(
				'title' => 'My Second Appointment',
				'start' => '2012-07-05',
			),
		),
		'options'=>array(
						'editable'=>true,
				),
				'htmlOptions'=>array(
						'style'=>'width:800px;margin: 0 auto;'
				),
		)
);
?>