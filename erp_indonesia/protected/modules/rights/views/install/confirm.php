<div id="installer" class="confirm">

<div class="page-header">
	<h1>	<?php //echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
	<?php echo Rights::t('install', 'Install Rights'); ?></h1>
</div>

	<p class="red-text">
		<?php echo Rights::t('install', 'Rights is already installed!'); ?>
	</p>

	<p><?php echo Rights::t('install', 'Please confirm if you wish to reinstall.'); ?></p>

	<p>
		<?php echo CHtml::link(Rights::t('install', 'Yes'), array('install/run', 'confirm'=>1)); ?> /
		<?php echo CHtml::link(Rights::t('install', 'No'), Yii::app()->homeUrl); ?>
	</p>

	<p class="info"><?php echo Rights::t('install', 'Notice: All your existing data will be lost.'); ?></p>

</div>