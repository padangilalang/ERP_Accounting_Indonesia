<?php
/**
 * @class JBusy
 * Show / hide an image to show the activity (for example, retrieveing data from ajax request)
 *
 * @see http://kammerer.boo.pl/code/jquery-busy/ for more informations and all available oprions
 *
 * @author parcouss
 */
class JBusy extends CComponent {
	public $minified = true; // use minified script

	public $preload = true; // register busy image on page load

	public $defaultOpts; // some jbusy global options

	/**
	 * @brief register parameters, scripts
	 */
	public function __construct($params = array()) {
		foreach ($params as $p => $v) $this->$p = $v;
		$ext = $this->minified ? '.min' : '';
		$assets = Yii::app()->extensionPath. DIRECTORY_SEPARATOR.'jbusy'.DIRECTORY_SEPARATOR.'source';
		$aUrl = Yii::app()->getAssetManager()->publish($assets);
		$jsFile = $aUrl.'/jquery.busy'.$ext.'.js';

		Yii::app()->clientScript->registerScriptFile($jsFile);

		if (!isset($this->defaultOpts)) $this->defaultOpts= array('img' => $aUrl.'/wait30trans.gif');
		else if (!array_key_exists('img', $this->defaultOpts)) $this->defaultOpts['img'] = $aUrl.'/wait30trans.gif';

		if ($this->preload || isset($this->defaultOpts)) {
			$script = '';
			if ($this->preload) $script = 'jQuery().busy("preload");';
			if (isset($this->defaultOpts)) $script .= 'jQuery().busy("defaults",'.CJavaScript::encode($this->defaultOpts).');';
			Yii::app()->clientScript->registerScript(__CLASS__, $script);
		}
	}

	protected function getSelector($mixed) {
		return is_string($mixed) ? $mixed : '#'.$mixed->id;
	}

	/**
	 * @brief create code needed to show the busy image
	 * @param widgetOrSelector widget instance or jQuery string selector
	 * @param options specific jbusy options
	 * @return the js code, not registered.
	 */
	public function createShowCode($widgetOrSelector, $options = array()) {
		return 'jQuery("'.$this->getSelector($widgetOrSelector).'").busy('.CJavaScript::encode($options).');';
	}

	/**
	 * @brief create code needed to hide the busy image
	 * @param widgetOrSelector widget instance or jQuery string selector
	 * @return the js code, not registered.
	 */
	public function createHideCode($widgetOrSelector) {
		return 'jQuery("'.$this->getSelector($widgetOrSelector).'").busy("hide");';
	}

	/**
	 * @brief Create an array wich may be encoded via CJavaScript::encode to provide options to pass to the $.ajax JQuery function.
	 * @param widgetOrSelector widget instance or jQuery string selector to apply busy
	 * @param options specific jbusy options for the show event
	 */
	public function createAjaxArray($widgetOrSelector, $options = array()) {
		return array(
				'beforeSend' => 'js:function() {'.$this->createShowCode($widgetOrSelector, $options).'}',
				'complete' => 'js:function() {'.$this->createHideCode($widgetOrSelector).'}'
		);
	}
}
