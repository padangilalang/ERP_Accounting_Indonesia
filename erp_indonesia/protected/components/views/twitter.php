<?php
 
	function parse_feed($process) {
        $xml = new SimpleXMLElement($process);
        $n=0;
        foreach($xml->channel->item as $entry) {
            $tweets[$n] = array('label'=>$entry->title,'icon'=>'list','url'=>'#');
            $n++;
			if ($n==5) break;
        }
        return $tweets;
    }

	$feed="http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=".Yii::app()->params['twittername'];

	//if (isset($tweets)) {
		$feed = file_get_contents($feed);
		$tweets = parse_feed($feed);
	//}
?>

<ul class="nav nav-list">
	<li class="nav-header">Twitter</li>
</ul>
<?php 
			if (isset($tweets)) {
				$this->widget('bootstrap.widgets.BootMenu', array(
						'type'=>'list',
						'items'=>$tweets,
				)); 
			}

?>
<br />

