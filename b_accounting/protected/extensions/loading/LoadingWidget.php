<?php

/**
 * Loading widget class file.
 *
 *
 * @author Vitaliy Stepanenko <mail@vitaliy.in>
 * @copyright Copyright &copy; 2011 Vitaliy Stepanenko
 * @license BSD
 *
 * @link http://www.yiiframework.com/extension/loading/
 *
 * @package widgets.loading
 * @version $Id:$ (1.0)
 */

/**
 * Loading widget.
 *
 */
class LoadingWidget extends CWidget
{
	private static $included = false;

	public function run()
	{
		if (self::$included) return;
		self::$included = true;
		$assetsPath = $this->getViewPath(true) . '/assets';
		$assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
		Yii::app()->clientScript
		->registerCoreScript('jquery')
		->registerCssFile($assetsUrl . '/Loading.css')
		->registerScriptFile($assetsUrl . '/Loading.js');
	}
}
