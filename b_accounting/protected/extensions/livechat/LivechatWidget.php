<?PHP
/**
 * @package Yii Framework < http://yiiframework.com >
 * @subpackage Widgets
 * @author Jason Clark ,  < mithereal@gmail.com >
 * @copyright 2010
 *
 *
 * Installation Instructions:
 * --------------------------
 *
 * 1. Download the extension
 * 2. Unzip the file contents
 * 3. Upload the LivechatWidget.php file to the extensions folder located under WebRoot/protected/extensions/livechat/.
 * 4. Upload the assets folder inside the livechat extension folder as such WebRoot/protected/extensions/livechat/assets/.
 * 5. Read Usage Instructions.
 *
 *
 * Requirements:
 * -------------
 *
 * * This should work on all Yii versions, But was tested on version 1.1.4 .
 *
 *
 * Usage:
 * ---------------
 * You will first need to generate a badge if you plan on using google talk. get a badge here http://www.google.com/talk/service/badge/New
 * and click  generate/update badge.
 * your account hash will be a number that looks like tk=z01q6...&amp so select the number between the tk= and &amp this is your hash.
 * $this->widget('application.extensions.livechat.LivechatWidget',
 array(
 'account_hash' =>'xxxx',    //your account hash
 'display_type' =>'default', //statusicon/hyperlink/url/custom/default
 'link_title' =>'Title of your Link', //link title
 'link_text' =>'Text of your Link', //link text
 'always_show_badge' =>'1', //we always show the badge even if away/offline
 'badge_on_away' =>'1', //we show badge on online and away only (not offline)
 ));

 *display_type options are statusicon (shows statusicon and hyperlink) hyperlink(shows hyperlink) and the url (the url).
 *display_type options are statusicon (shows statusicon and hyperlink) hyperlink(shows hyperlink) custom is a custom stylesheet in /css/and the url (the url).
 *link_title specifies the link text on other than default display.
 *link_text specifies the link text on other than default display.
 *badge_on_away shows the chat badge when status is away
 *always_show_badge always shows th badge regardless of status
 */

class LivechatWidget extends CWidget
{


	/**
	 * account token.
	 *
	 * @var string
	 */
	public $account_hash;


	/**
	 * display type.
	 *
	 * @var string
	 */
	public $display_type;

	/**
	 * show badge if user is away status.
	 *
	 * @var bool
	 */
	public $badge_on_away = 1;

	/**
	 * always show badge regardless of status.
	 *
	 * @var bool
	 */
	public $always_show_badge=0;

	/**
	 * link title
	 *
	 * @var string
	 */
	public $link_title='Click here to chat with support';

	/**
	 * link text
	 *
	 * @var string
	 */
	public $link_text='Chat with Support';

	/**
	 * Account we want to check
	 *
	 * @var string
	 */
	protected $account;

	/**
	 * server URL
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * Status. online/offline status
	 *
	 * @var bool
	 */
	protected $status;

	/**
	 * Status Message.
	 *
	 * @var bool
	 */
	protected $status_msg;

	/**
	 * assets.
	 *
	 * @var string
	 */
	protected $assets;

	/**
	 * Account data to display
	 *
	 * @var string
	 */
	protected $data;

	/**
	 * Widget Constructor
	 *
	 *
	 * @return checkStatus
	 */
	public function init() {
		$this->account = $this->account_hash;
		$this->url = 'http://www.google.com/talk/service/badge/Show?tk='.$this->account;
		if($this->assets===null && $this->display_type=='custom')
		{
			$file=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
			$this->assets=Yii::app()->getAssetManager()->publish($file);
			$this->registerClientScript();
		}
		$this->isOnline();
		$this-> _getStatus();
	}
	/**
	 * Run Widget and display
	 */
	public function run()
	{
		$this->data=$this->getBadge($this->display_type,$this->status);
		if($this->always_show_badge==1 )
		{
		 echo $this->data;
		}else{
			if($this->status == 2 || $this->badge_on_away == 1)
			{
				echo $this->data;
			}
		}
	}


	/**
	 * Check if $this->status == 2
	 *
	 * @return bool true if so
	 */
	public function isOnline() {
		$this->status = $this->_getStatus();
	}

	public function getStatusMsg() {
		$this->_getStatus();
		return $this->status_msg;
	}

	public function getBadge($type,$status=1)
	{
		switch  ($type)
		{
			case 'statusicon' :
				$data='<div class="statusicon" id="livechat">';
				$data.='<img style="padding: 0pt 2px 0pt 0pt; margin: 0pt; border: medium none;" src="http://www.google.com/talk/service/resources/chaticon.gif" alt="" height="14" width="16"><img style="padding: 0pt 2px 0pt 0pt; margin: 0pt; border: medium none;" src="http://www.google.com/talk/service/badge/Show?tk='.$this->account.'&amp;" alt="" ><a href="http://www.google.com/talk/service/badge/Start?tk='.$this->account.'" target="_blank" title="'.$this->link_title.'">'.$this->link_text.'</a>';
				$data .='</div>';
				break;
			case 'url' :
				$data='http://www.google.com/talk/service/badge/Start?tk='.$this->account;
				break;
			case 'hyperlink' :
				$data='<a href="http://www.google.com/talk/service/badge/Start?tk='.$this->account.'" target="_blank" title="'.$this->link_title.'">'.$this->link_text.'</a>';
				break;
			case 'custom' :
				if ($status ==0 || !isset($status) )
				{
					$data='<div id="status_offline">';

					$data.='</div>';
				}
				if ($status ==1 && $this->badge_on_away==1)
				{
					$data='<div id="status_away"  onclick="window.open (\'http://www.google.com/talk/service/badge/Start?tk='.$this->account. '\')";>';

	    $data.='</div>';
				}
				if ($status ==1 && $this->badge_on_away==0)
				{
					$data='<div id="status_offline">';

	    $data.='</div>';
				}
				if ($status ==2)
				{
					$data='<div id="status_online" onclick="window.open(\'http://www.google.com/talk/service/badge/Start?tk='. $this->account .' \') ";>';

	    $data.='</div>';
				}
				break;
			default :
				$data= '<iframe src="http://www.google.com/talk/service/badge/Show?tk='.$this->account.'&amp;w=200&amp;h=60" allowtransparency="true" width="200" frameborder="0" height="70" width="200"></iframe>';


		}
		return $data;
	}

	/**
	 * Just grab status
	 *
	 */
	private function _getStatus() {
		if (!empty($this->status)) {
			return;
		}
		$frame = file_get_contents($this->url);
		$m=array();
		if(preg_match('|img id=\"b\" src=\"/talk/service/resources/([\w]*)|',$frame,$m)){


			switch($m[1])
			{
				case 'online' :
					$this->status=2;
					break;
				case 'idle' :
					$this->status=1;
					break;
				default :
					$this->status=0;
			}

		}else{
			throw new Exception('Unable to determine online status due to misformed Google output. (Google Spewed Chunks) file:(Livechatwidget.php)');
		}
		$end=substr($frame,strpos($frame,'display:none'));
		$this->status_msg = trim(strip_tags(substr($end,21)));

	}

	protected function registerClientScript()
	{
		// ...publish CSS or JavaScript file here...
		$cs=Yii::app()->clientScript;
		$cs->registerCssFile($this->assets.'/livechat.css');
	}

}
?>
