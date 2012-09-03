<div id="installer" class="ready">

<div class="page-header">
	<h1>	<?php //echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
	<?php echo Rights::t('install', 'Congratulations!'); ?></h1>
</div>

	<p class="green-text">
		<?php echo Rights::t('install', 'Rights has been installed succesfully.'); ?>
	</p>

	<p>
		<?php echo Rights::t('install', 'You can start by generating your authorization items') ;?>
		<?php echo CHtml::link(Rights::t('install', 'here'), array('authItem/generate')); ?>.
	</p>

</div>