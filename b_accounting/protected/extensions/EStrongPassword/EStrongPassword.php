<?php
/*
 * EStrongPassword extension  - wrapper to include the pstrength jQuery plugin
* @yiiVersion 1.1.6
*/

/**
 * Description of EStrongPassword
 *
 * Per the http://plugins.jquery.com/project/pstrength
 *
 * @author Dana Luther <dluther@internationalstudent.com>
 * @version 1.0
 */
class EStrongPassword extends CWidget {

	private $_jsFile;

	public $model;
	public $attribute;
	public $form;
	public $htmlOptions;
	public $useMin = true;
	public $requirementOptions;

	protected $fieldName;

	public static $id_count=0;

	/**
	 * Initialize the widget, called by beginWidget or createWidget
	 */
	public function init()
	{
		if ($this->form === null)
		{
			throw new CHttpException(500, 'No form object specified.');
		}
		if ($this->model === null)
		{
			throw new CHttpException(500, 'No model passed to strongPassword');
		}
		if ($this->attribute === null)
		{
			if ($model->hasAttribute('password'))
				$this->attribute = 'password';
			else
				throw new CHttpException(500, 'No attribute specified for strongPassword');
		}

		$this->fieldName = "#".get_class($this->model)."_".$this->attribute;

		if ($this->htmlOptions === null )
		{
			$this->htmlOptions = array();
		}
		//$this->htmlOptions['id'] = "strPass".self::$id_count++;


	}

	/**
	 * Execute the widget, called by endWidget or when called without begin/end
	 */
	public function run()
	{
		Yii::app()->clientScript->registerCoreScript('jquery');

		if ( $this->useMin )
			$this->_jsFile = Yii::app()->assetManager->publish( dirname( __FILE__ ).'/js/digitialspaghetti.password.min.js');
		else
			$this->_jsFile = Yii::app()->assetManager->publish( dirname( __FILE__ ).'/js/digitalspaghetti.password.js');

		Yii::app()->clientScript->registerScriptFile($this->_jsFile);

		// default requirements
		$reqs = "{minChar: 5}";
		if ($this->requirementOptions !== null )
		{
			$reqs = CJSON::encode($this->requirementOptions);
		}

		Yii::app()->clientScript->registerScript('strPass'.self::$id_count++,"jQuery('".$this->fieldName."').pstrength({$reqs});");

		$form = $this->form;
		echo $form->passwordField( $this->model, $this->attribute,$this->htmlOptions);

	}

}
?>
