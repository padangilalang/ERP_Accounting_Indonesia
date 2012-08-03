<?php

/**
 * UIController is the customized base controller class with jQuery UI support.
 * All controller classes for this application should extend from this base class.
 */
Yii::import('zii.widgets.jui.CJuiWidget');

class UIController extends CExtController
{

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	/**
	 * @var int the user's Id
	 */
	public $uid;
	public $cs; // Client script

	public function init()
	{
		if (!Yii::app()->user->hasState('uid'))
			Yii::app()->user->setState('uid', Yii::app()->user->getId());
		$this->uid = Yii::app()->user->getState('uid');

		// for testing purpose
		if (empty($this->uid))
			$this->uid = 1;


		if ($this->getModule() !== null)
		{
			//add breadcrumbs link to module
			//$this->breadcrumbs[] = $this->module->id;
			// apply module layout
			if ($this->getModule()->layout !== null)
				$this->layout = $this->module->layout;
		}

		$this->registerUIscript();
	}

	private function registerUIscript()
	{
		$this->cs = Yii::app()->getClientScript();
		$this->cs->registerCoreScript('jquery');
		$this->cs->registerCssFile($this->cs->getCoreScriptUrl() . '/jui/css/2blitzer/jquery-ui-1.8.14.custom.css');
		//$this->cs->registerCssFile($this->cs->getCoreScriptUrl() . '/jui/css/'. $this->$theme . '/jquery-ui-1.8.14.custom.css');
		$this->cs->registerScriptFile($this->cs->getCoreScriptUrl() . '/jui/js/jquery-ui.min.js');
	}


	public function applyTheme($themeName)
	{
		if (!empty($themeName))
		{
			//$this->_theme = $themeName;
			$themeUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.components.assets.themes'));
			$this->cs->registerCssFile($themeUrl . '/' . $themeName . '/jquery-ui-1.8.10.custom.css');
		}
	}

}