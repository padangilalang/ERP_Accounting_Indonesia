<?php
/**
 * JAppendo class file.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @license BSD
 */

/**
 *
 * A widget that encapsulates the jQuery Appendo plugin.
 * Appendo is a lightweight plugin to manage cloning form rows.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @version: 0.2
 *
 * @see: http://deepliquid.com/content/Appendo.html
 */

Yii::setPathOfAlias('JAppendo',dirname(__FILE__));

class JAppendo extends CWidget
{
	/**
	 * @var mixed the CSS file used for the widget. Defaults to null, meaning
	 * using the default CSS file included together with the widget.
	 * If false, the default CSS file will be used. Otherwise, the specified CSS file
	 * will be included when using this widget.
	 */
	public $cssFile = false;

	/**
	 * Html ID (Selector)
	 * @var string
	 */
	public $id = '';
	/**
	 * Name of the view to display
	 * @var string
	 */
	public $viewName = '';
	/**
	 * @var CModel the data model associated with this widget.
	 */
	public $model;

	/**
	 * String value of "add" button (default: 'Add Row')
	 * @var string
	 */
	public $labelAdd;
	/**
	 * String value of "remove" button (default: 'Remove')
	 * @var string
	 */
	public $labelDel;
	/**
	 * Delete button will be shown if true (default:true)
	 * @var boolean
	 */
	public $allowDelete;
	/**
	 * Set to true to copy event handlers (default: false)
	 * @var boolean
	 */
	public $copyHandlers;
	/**
	 * Focus 'input:first' on added form rows (default: true)
	 * @var boolean
	 */
	public $focusFirst;
	/**
	 * Set to 0 for no limit (default)
	 * @var integer
	 */
	public $maxRows;
	/**
	 * callback: Called when a row has been added
	 * @var string
	 */
	public $onAdd;
	/**
	 * callback: Called before a row is removed (return true to delete)
	 * @var string
	 */
	public $onDel;
	/**
	 * Name of class to set on button wrapper div
	 * @var string
	 */
	public $wrapClass;
	/**
	 * jQuery CSS properties object to set on wrapper
	 * (default: { padding: '.4em .2em .5em' })
	 * @var string
	 */
	public $wrapStyle;
	/**
	 * jQuery CSS properties object to set on buttons
	 * (default: { marginRight: '.5em' })
	 * @var string
	 */
	public $buttonStyle;
	/**
	 *
	 * @var string
	 */
	public $subSelect;

	protected $baseUrl;
	protected $options = array();
	protected $cs;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		$this->baseUrl = CHtml::asset(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');

		$this->cs = Yii::app()->getClientScript();
		$this->cs->registerCoreScript('jquery');

		if (YII_DEBUG)
			$this->cs->registerScriptFile($this->baseUrl.'/js/jquery.appendo.js');
		else
			$this->cs->registerScriptFile($this->baseUrl.'/js/jquery.appendo.min.js');

		if($this->cssFile !== false)
			$this->cs->registerCssFile($this->cssFile);
		else
			$this->cs->registerCssFile($this->baseUrl.'/css/jquery.appendo.css');

		if ($this->viewName === '')
			throw new CException(Yii::t("JAppendo.main", 'viewName must be set!'));
		if ($this->id === '')
			throw new CException(Yii::t("JAppendo.main", 'ID of the HTML-element must be set!'));

	}

	/**
	 * Executes the widget.
	 */
	public function run()
	{
		$this->options = $this->getClientOptions();
		$js = $this->createJsCode();
		$this->cs->registerScript(__CLASS__.'#'.$this->id, $js, CClientScript::POS_READY);

		$this->renderFile(Yii::app()->basePath."/modules/m1/views/jAppendo/".$this->viewName.".php",array(
				'id'=>$this->id,
				'model'=>$this->model,
		));
	}

	/**
	 * The javascript needed
	 */
	protected function createJsCode()
	{
		$js = '';
		if (count($this->options)>0){
			$opts = CJavaScript::encode($this->options);
			$js .= "jQuery('#".$this->id."').appendo(".$opts.");";
		} else {
			$js .= "jQuery('#".$this->id."').appendo();";
		}
		return $js;
	}

	/**
	 * @return array the javascript options
	 */
	protected function getClientOptions()
	{

		static $properties=array(
				'labelAdd', 'labelDel', 'allowDelete', 'copyHandlers',
				'focusFirst', 'wrapClass', 'maxRows', 'wrapStyle',
				'buttonStyle', 'subSelect',
		);

		static $functions=array('onAdd', 'onDel');

		$options=$this->options;
		foreach($properties as $property)
		{
			if($this->$property!==null)
				$options[$property]=$this->$property;
		}
		foreach($functions as $func)
		{
			if(is_string($this->$func) && strncmp($this->$func,'js:',3))
				$options[$func]='js:'.$this->$func;
		}
		return $options;
	}
}