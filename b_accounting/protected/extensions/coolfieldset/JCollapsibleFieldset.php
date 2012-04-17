<?php
/**
 * JCollapsibleFieldset class file.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @license BSD
 */

/**
 * A widget that encapsulates the jQuery coolfieldset plugin for creating stylish collapsible fieldset.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @version: 1.0
 *
 * @see: http://www.http://w3shaman.com/article/jquery-plugin-collapsible-fieldset
 */

class JCollapsibleFieldset extends CWidget
{
	/**
	 * @var mixed the CSS file used for the widget.
	 * If false, the default CSS file will be used. Otherwise, the specified CSS file
	 * will be included when using this widget.
	 */
	public $cssFile=false;
	/**
	 * @var boolean Should the fieldset collapsed by start?
	 * Defaults to false.
	 */
	public $collapsed;
	/**
	 * @var boolean animate collapsing fieldset?
	 * Defaults to true.
	 */
	public $animation;

	/**
	 * @var boolean Should only the fieldset rendered without CSS-/Javascript files?
	 * Defaults to false.
	 */
	public $onlyFieldset=false;
	/**
	 * @var string the text for the legend
	 * Defaults to false.
	 */
	public $legend='';


	/**
	 * @var array additional HTML attributes that will be rendered in the fieldset tag.
	 */
	public $fieldsetHtmlOptions=array();
	/**
	 * @var array additional HTML attributes that will be rendered in the legend tag.
	 */
	public $legendHtmlOptions=array();
	/**
	 * @var array additional HTML attributes that will be rendered in the div tag.
	 */
	public $divHtmlOptions=array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();

		if(isset($this->fieldsetHtmlOptions['id']))
			$id=$this->fieldsetHtmlOptions['id'];
		else
			$id=$this->fieldsetHtmlOptions['id']=$this->getId();

		if (!$this->onlyFieldset){
			$baseUrl = CHtml::asset(dirname(__FILE__).'/assets');
			$cssFile=($this->cssFile!==false)?$this->cssFile:$baseUrl.'/css/jquery.coolfieldset.css';
			$jsFile=(YII_DEBUG)?'/js/jquery.coolfieldset.js':'/js/jquery.coolfieldset.min.js';

			Yii::app()->getClientScript()
			->registerCoreScript('jquery')
			->registerScriptFile($baseUrl.$jsFile)
			->registerScript(__CLASS__.'#'.$id, $this->createJsCode($id))
			->registerCssFile($cssFile);
		}
		$this->renderBeginMarkup();
	}

	/**
	 * Executes the widget.
	 */
	public function run()
	{
		$this->renderEndMarkup();
	}

	/**
	 * The javascript needed
	 */
	protected function createJsCode($id)
	{
		$optsArr=$this->getClientOptions();
		if (count($optsArr)){
			$opts = CJavaScript::encode($optsArr);
			return "jQuery('#{$id}').coolfieldset($opts);";
		}
		return "jQuery('#{$id}').coolfieldset();";
	}

	/**
	 * @return array the javascript options
	 */
	protected function getClientOptions()
	{
		$options = array();
		static $properties=array('collapsed', 'animation');

		foreach($properties as $property)
		{
			if($this->$property!==null)
				$options[$property]=$this->$property;
		}
		return $options;
	}

	protected function renderBeginMarkup(){

		if (!$this->onlyFieldset)
			$this->fieldsetHtmlOptions['class']=(isset($this->fieldsetHtmlOptions['class']))
			? 'coolfieldset '.$this->fieldsetHtmlOptions['class']
			: 'coolfieldset';

		echo CHtml::openTag('fieldset',$this->fieldsetHtmlOptions);
		echo CHtml::tag('legend',$this->legendHtmlOptions,$this->legend);
		if (!$this->onlyFieldset)
			echo CHtml::openTag('div',$this->divHtmlOptions);

	}

	protected function renderEndMarkup(){
		if (!$this->onlyFieldset)
			echo CHtml::closeTag('div');
		echo CHtml::closeTag('fieldset');
	}
}
