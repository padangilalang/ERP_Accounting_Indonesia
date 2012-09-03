
<?php
$this->widget('createNew');
?>

<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-world">Communication</span>
	</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				array('label'=>'SMS', 'icon'=>'list-alt','url'=>'#'),
				array('label'=>'Email', 'icon'=>'list-alt','url'=>'#'),
				array('label'=>'Chat', 'icon'=>'list-alt','url'=>'#'),
				array('label'=>'Click To Call', 'icon'=>'list-alt','url'=>'#'),
		),
)); ?>
<br />



<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-user">Personalization</span>
	</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				array('label'=>'Inbox', 'count'=>Yii::app()->getModule("mailbox")->getNewMsgs(Yii::app()->user->id), 'icon'=>'list-alt','url'=>Yii::app()->createUrl('/mailbox')),
				array('label'=>'Profile', 'icon'=>'list-alt','url'=>Yii::app()->createUrl('/sUser/viewPublic',array('id'=>Yii::app()->user->id))),
				array('label'=>'Theme', 'icon'=>'list-alt','url'=>'#'),
				array('label'=>'Bookmark', 'icon'=>'list-alt','url'=>'#'),
		),
)); ?>
<br />


<ul class="nav nav-list">
	<li class="nav-header"><span class="h-icon-folder_database">File Management</span>
	</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				array('label'=>'Public Folder', 'icon'=>'list-alt','url'=>Yii::app()->createUrl('/sFileBrowser/publicFolder')),
				array('label'=>'Personal Folder', 'icon'=>'list-alt','url'=>Yii::app()->createUrl('/sFileBrowser/personalFolder')),
		),
)); ?>
<br />
