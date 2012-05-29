<ul class="nav nav-list">
  <li class="nav-header">
    Personalization
  </li>
</ul>

<?php $this->widget('bootstrap.widgets.BootMenu', array(
	'type'=>'list',
	'items'=>array(
		array(
			'label'=>'Inbox ('.sNotification::model()->getUnreadNotification().') ', 'icon'=>'list-alt',
			'url'=>Yii::app()->createUrl('sNotification'),
		),
		array('label'=>'Profile', 'icon'=>'list-alt','url'=>'#'),
		array('label'=>'Theme', 'icon'=>'list-alt','url'=>'#'),
		array('label'=>'Bookmark', 'icon'=>'list-alt','url'=>'#'),
	),
)); ?>
<br/>

<?php 
//$this->widget('bootstrap.widgets.BootBadge', array(
//    'type'=>'success', // '', 'success', 'warning', 'error', 'info' or 'inverse'
//    'label'=>sNotification::model()->getUnreadNotification(),
//)); 

?>
