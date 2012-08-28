<?php
/**
 * yRssTwitter widget
 *
 * Parses data from the Rss feed of a twitter timeline a shows it nicely
 *
 * @filesource
 * @copyright    Copyright 2012 Why Not Soluciones, S.L. - All Rights Reserved
 * @package      yRssTwitter
 * @license      http://opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 */
class YRssTwitter extends CWidget {

	/**
	 * @var Parameters for yRssTwitter
	 */
	public $rss;
	public $display = true;
	public $displayName = 'Why Not Soluciones';
	public $twitterUser = 'ynotsoluciones';
	public $locales = array("es_ES.UTF-8", "es_ES@euro", "es_ES", "esp");
	public $timeNames = array('segundo', 'minuto', 'hora', 'día', 'semana', 'mes', 'año', 'decada');
	public $tweetsToDisplay = 5;
	public $twitterLogo = 'dark';
	public $minscript = true;
	public $color = '#361d27';
	public $linkColor = '#361d27';
	public $linkHoverColor = '#FF6319';
	public $twitterActions = array('reply'=>'responder', 'favorite'=>'favorito');

	/**
	 * @var string Path of CSS file and image file to use
	 */
	public $cssFile;
	public $imageFile;

	function timeFromPublish($tm, $rcs = 0) {
		$cur_tm = time();
		$dif = $cur_tm - $tm;
		$lngh = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);

		for ($v = sizeof($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--)
			;

		if ($v < 0) {
			$v = 0; $_tm = $cur_tm - ($dif % $lngh[$v]);
		}

		$no = floor($no);
		$useName = $this->timeNames[$v];
		if ($no != 1) {
			if($useName == "mes") {
				$useName .= 'es';
			} else {
				$useName .= 's';
			}
		}

		$x = sprintf("%d %s ", $no, $useName);
		if (($rcs == 1) && ($v >= 1) && (($cur_tm - $_tm) > 0)) {
			$x .= time_ago($_tm);
		}

		return $x;
	}

	private function parse_twitter($t, $username) {
		// link URLs
		$t = " " . preg_replace("/(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]*)" .
				"([[:alnum:]#?\/&=])/i", "<a href=\"\\1\\3\\4\" target=\"_blank\">" .
				"\\1\\3\\4</a>", $t);

		// link mailtos
		$t = preg_replace("/(([a-z0-9_]|\\-|\\.)+@([^[:space:]]*)" .
				"([[:alnum:]-]))/i", "<a href=\"mailto:\\1\">\\1</a>", $t);

		//link twitter users
		$t = preg_replace("/ +@([a-z0-9_]*) ?/i", " <a href=\"http://twitter.com/\\1\" target=\"_blank\">@\\1</a> ", $t);

		//link twitter arguments
		$t = preg_replace("/ +#([a-z0-9_]*) ?/i", " <a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">#\\1</a> ", $t);

		// truncates long urls that can cause display problems (optional)
		$t = preg_replace("/>(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]" .
				"{30,40})([^[:space:]]*)([^[:space:]]{10,20})([[:alnum:]#?\/&=])" .
				"</", ">\\3...\\5\\6<", $t);

		$t = str_replace($username . ": ", '<a href="http://twitter.com/#!/' . $username . '">'.$username.'</a>:' , $t);

		return trim($t);
	}

	private function getTwitterRss($username, $locales) {


		$source = 'https://twitter.com/statuses/user_timeline/' . $username . '.rss';

		$xml = @simplexml_load_file($source);
		for ($n = 0; $n < $this->tweetsToDisplay; $n++) {
			$description = $xml->channel->item[$n]->description;

			$description = $this->parse_twitter($description, $username);

			$dateFormat = "%s";

			$guid = $xml->channel->item[$n]->guid;
			$pubDate = @strtotime($xml->channel->item[$n]->pubDate);

			setlocale(LC_TIME, $locales);
			$returnEntry[$n]['date'] = $this->timeFromPublish(@strftime($dateFormat, $pubDate));
			$returnEntry[$n]['guid'] = $guid;
			$returnEntry[$n]['replyUrl'] = 'https://twitter.com/intent/tweet?in_reply_to=' . basename($guid);
			$returnEntry[$n]['retweetUrl'] = 'https://twitter.com/intent/retweet?tweet_id=' . basename($guid);
			$returnEntry[$n]['favoriteUrl'] = 'https://twitter.com/intent/retweet?tweet_id=' . basename($guid);
			$returnEntry[$n]['description'] = $description;
		}

		return $returnEntry;
	}


	/**
	 * Initialises the widget
	 */
	public function init() {

		$this->rss = @$this->getTwitterRss($this->twitterUser, $this->locales);

		$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'yRssTwitter.css';
		$imageFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'twitter-' . $this->twitterLogo . '.png';

		// If we are using minscript, we want to have always the same hash,
		// so we use a true with publish
		$this->cssFile = Yii::app()->getAssetManager()->publish($file, $this->minscript);
		$this->imageFile = Yii::app()->getAssetManager()->publish($imageFile, $this->minscript);


		Yii::app()->getClientScript()->registerCssFile($this->cssFile);
	}

	/**
	 * Display the Twitter timeline
	 *
	 * The cached forecast is used if enabled and not expired
	 */
	public function run() {


		Yii::app()->getClientScript()->registerCss('yRssTwitterCss', '
				#yRssTwitter .yRssTwitter-header {
				border: 1px solid ' . $this->color . ';
	}

				#yRssTwitter a {
				font-weight: bold;
				color: ' . $this->linkColor . ';
	}

				#yRssTwitter a:hover {
				color: ' . $this->linkHoverColor . ';
				cursor: pointer;
	}

				#yRssTwitter .yRssTwitter-header-left {
				background: ' . $this->color . ';
	}

				#yRssTwitter .yRssTwitter-footer {
				background-color: ' . $this->color . ';
	}

				', 'screen', CClientScript::POS_HEAD);

		if($this->display == true) {
			$this->render('yRssTwitter', array(
					'displayName' => $this->displayName,
					'twitterUser' => $this->twitterUser,
					'rss' => $this->rss,
					'logoStyle' => 'background-image: url(' . $this->imageFile . ')',
					'twitterActions' => $this->twitterActions,
			));
		}
	}
}

?>
