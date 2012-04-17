<?php
/**
 * JTextboxHinter class file.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @version 1.0
 * @license BSD
 */

/**
 * This widget encapsulates the textbox hinter-jQuery plugin.
 * Jquery textbox hinter is plugin which allows to add hints to textboxes and textareas.
 * Acts as a complete replacement for labels.
 * ({@link http://www.aakashweb.com/jquery-plugins/textbox-hinter/}).
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 */

class JTextboxHinter extends CInputWidget
{
	/**
	 * @var boolean whether to show the hint using a text area.
	 * Defaults to false, meaning a text field is used.
	 */
	public $textArea=false;

	/**
	 * @var mixed the CSS file used for the widget.
	 * If false, the default CSS file will be used. Otherwise, the specified CSS file
	 * will be included when using this widget.
	 */
	public $cssFile=false;

	/**
	 * @var string the text for the hint
	 * Defaults to 'Enter a text ...'
	 */
	public $text;

	/**
	 * @var string CSS class for the hint text
	 * Defaults to ''
	 */
	public $class = false;

	/**
	 * @var boolean If true, then dont't generate the html controls (input, textarea).
	 * So you  can combine this widget width other widgets.
	 *
	 */
	public $onlyScript = false;


	protected $baseUrl;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->baseUrl = CHtml::asset(dirname(__FILE__).'/assets');

		list($name,$id)=$this->resolveNameID();
		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];
		else
			$this->htmlOptions['name']=$name;

		$this->registerClientScript();
		if (!$this->onlyScript){
			if($this->hasModel())
			{
				$field=$this->textArea ? 'activeTextArea' : 'activeTextField';
				echo CHtml::$field($this->model,$this->attribute,$this->htmlOptions);
			}
			else
			{
				$field=$this->textArea ? 'textArea' : 'textField';
				echo CHtml::$field($name,$this->value,$this->htmlOptions);
			}
		}
	}

	/**
	 * Registers the needed CSS and JavaScript.
	 */
	public function registerClientScript()
	{
		$id=$this->htmlOptions['id'];
		$acOptions=$this->getClientOptions();
		$options=$acOptions===array()?'{}' : CJavaScript::encode($acOptions);

		$cs=Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');

		if (YII_DEBUG)
			$cs->registerScriptFile($this->baseUrl.'/js/jquery.textbox-hinter.js');
		else
			$cs->registerScriptFile($this->baseUrl.'/js/jquery.textbox-hinter.min.js');

		if($this->cssFile!==false)
			$this->registerCssFile($this->cssFile);
		else
			$this->registerCssFile();

		$cs->registerScript(__CLASS__.'#'.$id,"jQuery(\"#{$id}\").tbHinter($options);");
	}

	/**
	 * Registers the needed CSS file.
	 * @param string the CSS URL. If null, a default CSS URL will be used.
	 */
	public function registerCssFile($url=null)
	{
		$cs=Yii::app()->getClientScript();
		if($url===null)
			$url = $this->baseUrl.'/css/jquery.textbox-hinter.css';
		$cs->registerCssFile($url);
	}

	/**
	 * @return array the javascript options
	 */
	protected function getClientOptions()
	{
		$options = array();
		static $properties=array('text', 'class',);

		foreach($properties as $property)
		{
			if($this->$property!==null)
				$options[$property]=$this->$property;
		}
		return $options;
	}
}
