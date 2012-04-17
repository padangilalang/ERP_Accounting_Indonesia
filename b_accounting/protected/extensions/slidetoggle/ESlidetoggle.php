<?php

/**
 * ESlidetoggle.php
 *
 * Make containers collapsible (fieldset,portlet,div,ul ...)
 *
 * @author Joe Blocher <yii@myticket.at>
 * @copyright 2011 myticket it-solutions gmbh
 * @license New BSD License
 * @category User Interface
 * @version 1.1.2
 */
class ESlidetoggle extends CWidget
{
	/**
	 * The CSS file used for the widget.
	 * If not is set, the default CSS file will be used.
	 * @see assets/css/jquery.slidetoggle.css
	 *
	 * @var string $cssFile
	 */
	public $cssFile;

	/**
	 * The jQuery selector for the items to make collapsible.
	 * Default: all fieldsets
	 *
	 * @var string $itemSelector
	 */
	public $itemSelector = 'fieldset';

	/**
	 * The jQuery selector for the title
	 * The title must be a child of the collapsible item
	 * Default: the legend of a fieldset
	 *
	 * @var string $titleSelector
	 */
	public $titleSelector = 'legend';

	/**
	 * The jQuery selector for the per default closed items
	 * Set it to the same selection as the $itemSelector to show all closed
	 * Otherwise add a class to the items:
	 *
	 * Example: $collapsed = 'fieldset.closed'
	 * HTML: <fieldset class='closed'><legend>Closed Fieldset</legend> ....</fieldset>
	 *
	 *
	 * @var string collapsed
	 */
	public $collapsed;

	/**
	 * Show a toggle arrow
	 * @see assets/css/jquery.slidetoggle.css
	 *
	 * @var string $arrow
	 */
	public $arrow = true;

	/**
	 * Duration for jQuery slidetoggle:
	 * 'slow','fast' or time in ms
	 *
	 * @var string $duration
	 */
	public $duration = 'slow'; //'slow','fast' or time in ms

	/**
	 * Easing of jQuery slidetoggle: 'linear','swing','easeInBounce',..
	 * One of the easing methods listet in assets/js/jquery.easing.1.3.js
	 * Examples @link http://gsgd.co.uk/sandbox/jquery/easing/
	 *
	 * @var string $easing
	 */
	public $easing = 'swing';

	/**
	 * This classes are used internally for handling slidetoggle.
	 *
	 * No need for change.
	 * If you change this if you have to change the css too.
	 * @see assets/css/jquery.slidetoggle.css
	 */
	public $classCollapsible = 'slidetoggle-collapsible';
	public $classCollapsed = 'slidetoggle-collapsed';

	/**
	 * Registers the javascript code.
	 */
	public function registerClientScript()
	{
		$baseUrl = CHtml::asset(dirname(__FILE__).'/assets');
		$cssFile = isset($this->cssFile) ? $this->cssFile : $baseUrl.'/css/jquery.slidetoggle.css';
		$jsFile = $baseUrl.'/js/jquery.slidetoggle.js';
		$jsFileEasing = $baseUrl.'/js/jquery.easing.1.3.js';

		$options = array(
				'duration' => $this->duration,
				'easing' => $this->easing,
				'classCollapsed' => $this->classCollapsed,
		);

		$clientScript = Yii::app()->getClientScript();
		$clientScript->registerCoreScript('jquery');
		$clientScript->registerScriptFile($jsFile);
		$clientScript->registerScriptFile($jsFileEasing);
		$clientScript->registerCssFile($cssFile);

		$id = __CLASS__.'#'.$this->getId();
		$titleClass = $this->arrow ? $this->classCollapsible . ' arrow' : $this->classCollapsible;

		$jsCode = "jQuery('{$this->titleSelector}').addClass('$titleClass');";

		if (!empty($this->collapsed))
		{
			$jsCode .= "jQuery('{$this->collapsed}').children().not('{$this->titleSelector}').hide();";
			$jsCode .= "jQuery('{$this->collapsed}').children('{$this->titleSelector}').addClass('$titleClass {$this->classCollapsed}');";
		}

		$jsOptions =  CJavaScript::encode($options);
		$jsCode .= "jQuery('{$this->titleSelector}').collapse($jsOptions);";

		$clientScript->registerScript($id, $jsCode);
	}

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		$this->registerClientScript();
	}
}
