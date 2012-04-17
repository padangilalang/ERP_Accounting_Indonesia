<?php

/**
 * JuiButtonSet is a widget displaying menu items in a JuiToolbar.
 *
 * @author Ricardo Obregón <robregonm@gmail.com>
 * @website http://obregon.co/
 */
Yii::import('zii.widgets.jui.CJuiWidget');
Yii::import('zii.widgets.CMenu');

class JuiButtonSet extends CJuiWidget {

	/**
	 * Items.
	 *
	 * 	array('label', 'url', additional options..)
	 *
	 * Additional Options:
	 * - visible
	 * - pattern
	 * 		pattern used to check if this item matches current page.  Otherwise the url
	 * 		option is used
	 * - htmlOptions
	 */
	public $items = array();
	public $actionPrefix = '';
	public $itemTemplate;
	//public $encodeLabel = true;
	public $activeCssClass = 'active';
	public $activateItems = true;
	public $activateParents = false;
	public $hideEmptyItems = true;
	public $htmlOptions = array();
	public $submenuHtmlOptions = array();
	public $linkLabelWrapper;
	public $firstItemCssClass;
	public $lastItemCssClass;
	/**
	 * Whether to hide any active/open menu items
	 */
	public $hideActive = false;
	/**
	 * The view to use
	 */
	public $view = 'default';
	private $menu;

	public function run() {
		$cs = Yii::app()->clientScript;
		$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR;
		$baseUrl = Yii::app()->getAssetManager()->publish($dir . 'assets');
		$clientScript = Yii::app()->getClientScript();
		//$clientScript->registerCssFile($baseUrl . '/s3Slider.css.php?data=' . urlencode(base64_encode(serialize($cssparams)))); //http_build_query($cssparams)
		$clientScript->registerCssFile($baseUrl . '/JuiButtonSet.css.php');
		$clientScript->registerCoreScript('jquery');
		$clientScript->registerScriptFile($baseUrl . '/JuiButtonSet.js');

		echo '<div class="fg-toolbar ui-widget-header ui-corner-all ui-helper-clearfix">';
		echo '<div class="fg-buttonset ui-helper-clearfix">';
		$this->items = $this->parseItems($this->items);
		$this->menu = new CMenu();
		$this->menu->actionPrefix = $this->actionPrefix;
		$this->menu->activateItems = $this->activateItems;
		$this->menu->activateParents = $this->activateParents;
		$this->menu->activeCssClass = $this->activeCssClass;
		$this->menu->encodeLabel = false;
		$this->menu->firstItemCssClass = $this->firstItemCssClass;
		$this->menu->hideEmptyItems = $this->hideEmptyItems;
		$this->menu->htmlOptions = $this->htmlOptions;
		$this->menu->itemTemplate = $this->itemTemplate;
		$this->menu->lastItemCssClass = $this->lastItemCssClass;
		$this->menu->linkLabelWrapper = $this->linkLabelWrapper;
		$this->menu->skin = $this->skin;
		$this->menu->items = $this->items;
		$this->menu->init();
		//$items = $this->parseItems($this->items);
		//$this->render($this->view, compact('items'));
		$this->menu->run();
		echo '</div></div>';
	}

	protected function parseItems($items) { //_items
		foreach ($items as $key => $item) {
			if (empty($item['linkOptions']['class'])) {
				$items[$key]['linkOptions']['class'] = 'fg-button ui-state-default ui-corner-all';
			} else {
				$items[$key]['linkOptions']['class'] .= ' fg-button ui-state-default ui-corner-all';
			}
			if (empty($item['itemOptions']['class'])) {
				$items[$key]['itemOptions']['class'] = 'column';
			} else {
				$items[$key]['itemOptions']['class'] .= ' column';
			}
			if (empty($item['label'])) {
				$items[$key]['label'] = '&nbsp;';
			}
			if (empty($item['icon'])) {
				$turl = $item['url'];
				if (is_array($turl)) {
					$turl = reset($turl);
				}
				if (strpos($turl, 'create') !== false) {
					$item['icon'] = 'circle-plus';
				} elseif (strpos($turl, 'update') !== false) {
					$item['icon'] = 'pencil';
				} elseif (strpos($turl, 'admin') !== false) {
					$item['icon'] = 'wrench';
				} elseif (strpos($turl, 'delete') !== false or strpos(@$item['linkOptions']['submit'][0], 'delete') !== false) {
					$item['icon'] = 'trash';
				}
			}
			switch (@$item['icon-position']) {
				case 'left':
				case 'right':
				case 'top':
				case 'bottom':
				case 'solo':
					break;
				default:
					$item['icon-position'] = 'left';
				break;
			}

			if (!empty($item['icon'])) {
				$items[$key]['linkOptions']['class'] .= ' fg-button-icon-' . $item['icon-position'];
				$items[$key]['label'] = '<span class="ui-icon ui-icon-' . $item['icon'] . '">&nbsp;</span>' . $items[$key]['label'];
				unset($items[$key]['icon']);
			}
			unset($items[$key]['icon-position']);
		}
		return $items;
	}

	protected function isActive($pattern, $controllerID, $actionID) {
		if (!is_array($pattern) || !isset($pattern[0]))
			return false;
		$pattern[0] = trim($pattern[0], '/');
		if (strpos($pattern[0], '/') !== false)
			$matched = $pattern[0] === $controllerID . '/' . $actionID;
		else
			$matched=$pattern[0] === $controllerID;

		if ($matched && count($pattern) > 1) {
			foreach (array_splice($pattern, 1) as $name => $value) {
				if (!isset($_GET[$name]) || $_GET[$name] != $value)
					return false;
			}
			return true;
		}
		else
			return $matched;
	}

}