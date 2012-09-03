<div id="installer" class="error">

<div class="page-header">
	<h1><?php //echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
	<?php echo Rights::t('install', 'Error'); ?></h1>
</div>

	<p class="red-text">
		<?php echo Rights::t('install', 'An error occurred while installing Rights.'); ?>
	</p>

    <p>
		<?php echo Rights::t('install', 'Please try again or consult the documentation.') ;?>
	</p>

</div>