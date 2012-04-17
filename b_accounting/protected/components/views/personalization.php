<ul class="nav nav-list">
  <li class="nav-header">
    Personalization
  </li>
</ul>

<?php $this->widget('bootstrap.widgets.BootMenu', array(
	'type'=>'list',
	'items'=>array(
		array(
			'label'=>'Inbox ('.sNotification::model()->getUnreadNotification().')',
			'url'=>Yii::app()->createUrl('sNotification'),
		),
		array('label'=>'Profile','url'=>'#'),
		array('label'=>'Theme','url'=>'#'),
		array('label'=>'Bookmark','url'=>'#'),
	),
)); ?>
<br/>

<?php 
//$this->widget('bootstrap.widgets.BootBadge', array(
//    'type'=>'success', // '', 'success', 'warning', 'error', 'info' or 'inverse'
//    'label'=>sNotification::model()->getUnreadNotification(),
//)); 

?>
