<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-user">Personalization</span>
	</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				array('label'=>'Inbox', 'count'=>Yii::app()->getModule("mailbox")->getNewMsgs(Yii::app()->user->id), 'icon'=>'list-alt','url'=>Yii::app()->createUrl('/mailbox')),
				array('label'=>'Profile', 'icon'=>'list-alt','url'=>'#'),
				array('label'=>'Theme', 'icon'=>'list-alt','url'=>'#'),
				array('label'=>'Bookmark', 'icon'=>'list-alt','url'=>'#'),
		),
)); ?>
<br />
