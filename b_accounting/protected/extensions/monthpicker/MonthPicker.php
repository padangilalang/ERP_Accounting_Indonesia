<?php
class monthpicker extends CWidget {

	public $assets = '';
	public $options = array();
	public $skin = 'default';

	public $model;
	public $name;


	public function init() {
		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');

		Yii::app()->clientScript
		->registerScriptFile( $this->assets.'/monthpicker.min.js' )

		->registerCssFile( $this->assets.'/monthpicker.css' );

		$options=empty($this->options) ? '' : CJavaScript::encode($this->options);

		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$this->id,"
				jQuery('#{$this->id}').monthpicker();
				");

		parent::init();
	}

	public function run(){
	$this->render($this->skin);
	}
}
?>