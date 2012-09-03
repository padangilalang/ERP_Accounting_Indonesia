<?php
if (Yii::app()->user->name ==='admin') :
?>

	<div class="row">
	<div class="span3">

		<?php

		$gridDataProvider = new CArrayDataProvider(array(
			array('id'=>1, 'icon'=>'icon-people.png','url'=>Yii::app()->createUrl('/sUser')),
			array('id'=>2, 'icon'=>'icon-directions.png','url'=>Yii::app()->createUrl('/rights')),
			array('id'=>3, 'icon'=>'icon-count.png','url'=>Yii::app()->createUrl('/sModule')),
			array('id'=>4, 'icon'=>'icon-gear2.png','url'=>Yii::app()->createUrl('/sSqlStatement')),
			array('id'=>5, 'icon'=>'icon-file-zip.png','url'=>Yii::app()->createUrl('/sAdmin/backup')),
			array('id'=>6, 'icon'=>'icon-grid2.png','url'=>Yii::app()->createUrl('/sFileBrowser')),
		));
		?>

		<br />
		<ul class="nav nav-list">
			<li class="nav-header">Favourite Admin Menu</li>
		</ul>
		<?php $this->widget('bootstrap.widgets.BootThumbnails', array(
			'dataProvider'=>$gridDataProvider,
			'template'=>"{items}",
			'itemView'=>'_thumb',
		)); ?>

	</div>
	</div>

<?php endif; ?>

<br />

<!-- Feed widget -->
<ul class="nav nav-list">
	<li class="nav-header">Business News - viva.co.id</li>
</ul>
<?php 
$this->widget(
   'ext.yii-feed-widget.YiiFeedWidget',
   array('url'=>'http://rss.vivanews.com/get/bisnis','limit'=>3)
); 
?>

<br />
<br />

<?php
$config = array( 
                  'display' => true, 
                  'displayName' => Yii::app()->params['twitterdisplay'], 
                  'twitterUser' => Yii::app()->params['twittername'], 
                  'twitterActions' => array(
                                    'reply'=>'reply', 
                                    'favorite'=>''
                  ), 
                  'tweetsToDisplay' => 3, 
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
?>	

<div class="row">
<div class="span3">
<?php	
    $this->widget('ext.yRssTwitter.YRssTwitter', $config)
?>
</div>
</div>
<br />
<br />
