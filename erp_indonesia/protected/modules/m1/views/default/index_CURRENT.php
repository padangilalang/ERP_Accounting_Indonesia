<?php
$this->breadcrumbs=array(
		$this->module->id,
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/company.png') ?>
		Welcome!!
	</h1>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php
		echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/flowers_32.jpg','image',array('style'=>'width: 100%'));
		?>
	</div>
</div>

<br />

<div class="row-fluid">
	<div class="span12">
		<?php $this->beginWidget('bootstrap.widgets.BootHero', array(
				//'heading'=>'Welcome!!',
		)); ?>

		<p>ERP Module. This page has been reserved for future use. Thank you
			for using this product</p>

		<p>
			<?php $this->widget('bootstrap.widgets.BootButton', array(
					'type'=>'primary',
					'size'=>'large',
					'label'=>'Learn more',
			)); ?>
		</p>

		<?php $this->endWidget(); ?>
	</div>
</div>

<?php
/*
 $config = array(
 		'display' => true,
 		'displayName' => 'Agung Podomoro',
 		'twitterUser' => 'peterjkambey',
 		'twitterActions' => array(
 				'reply'=>'reply',
 				'favorite'=>'favorite'
 		),
 		'tweetsToDisplay' => 2,
 		'locales' => array("en_EN.UTF-8", "en_EN"),
 		'timeNames' => array(
 				'second',
 				'minute',
 				'hour',
 				'day',
 				'week',
 				'month',
 				'year',
 				'decade'
 		),
 		'minscript' => true,
 		'twitterLogo' => 'dark',
 		'color' => 'black',
 		'linkColor' => 'green',
 		'linkHoverColor' => 'red'
 );

$this->widget('ext.yRssTwitter.YRssTwitter', $config);
*/
?>