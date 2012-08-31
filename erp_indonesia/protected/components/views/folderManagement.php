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
