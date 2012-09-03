<div class="art-post">
	<?php
	$_val=$this->action->id;

	$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
			array('label'=>Rights::t('core', 'Assignments'),'url'=>Yii::app()->createUrl('/rights/assignment/view'),
				'active'=>($_val=='view')?true:false),
			array('label'=>Rights::t('core', 'Permissions'),'url'=>Yii::app()->createUrl('/rights/authItem/permissions'),
				'active'=>($_val=='permissions')?true:false),
			array('label'=>Rights::t('core', 'Roles'),'url'=>Yii::app()->createUrl('/rights/authItem/roles'),
				'active'=>($_val=='roles')?true:false),
			array('label'=>Rights::t('core', 'Tasks'),'url'=>Yii::app()->createUrl('/rights/authItem/tasks'),
				'active'=>($_val=='tasks')?true:false),
			array('label'=>Rights::t('core', 'Operations'),'url'=>Yii::app()->createUrl('/rights/authItem/operations'),
				'active'=>($_val=='operations')?true:false),
		),
	));
	?>
</div>
