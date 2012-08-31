<?php

Yii::import('zii.widgets.CMenu');

/**
 * @author Nicola Puddu
 * @see CMenu
 * @version 1.2
 */
class AjaxMenu extends CMenu {

	/**
	 * @var boolean
	 */
	public $optionalIndex = false;
	/**
	 * @var mixed may contain the ajaxOptions array or a boolean false
	 */
	public $ajax = false;
	/**
	 * @var boolean
	 */
	public $randomID = false;
	/**
	 * @var int counter for the menu items
	 */
	private $_itemCounter = 0;

	/**
	 * @see CMenu::isItemActive()
	 */
	protected function isItemActive($item,$route)
	{
		$optional_index = $this->optionalIndex ? !strcasecmp(str_replace('/index', NULL, $route),trim($item['url'][0], '/')) : false;

		if(isset($item['url']) && is_array($item['url']) && (!strcasecmp(trim($item['url'][0],'/'),$route) ) || $optional_index)
		{
			if(count($item['url'])>1)
			{
				foreach(array_splice($item['url'],1) as $name=>$value)
				{
					if(!isset($_GET[$name]) || $_GET[$name]!=$value)

						return false;
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * @see CMenu::renderMenuItem()
	 */
	protected function renderMenuItem($item) {
		// raise the item counter
		$this->_itemCounter++;
		if (isset($item['url'])) {
			// sets the link label
			$label = $this->linkLabelWrapper === null ? $item['label'] : '<' . $this->linkLabelWrapper . '>' . $item['label'] . '</' . $this->linkLabelWrapper . '>';
			// creates the ajax link
			if (($this->ajax && (!isset($item['ajax']) || (isset($item['ajax']) && $item['ajax'] !== false))) || (isset($item['ajax']) && $item['ajax'])) {
				// set the new id if randomID is true
				if ($this->randomID)
					$item['linkOptions']['id'] = isset($item['linkOptions']['id']) ? $item['linkOptions']['id'] . rand() : 'am' . uniqid();
				else
					$item['linkOptions']['id'] = isset($item['linkOptions']['id']) ? $item['linkOptions']['id'] : 'am-' . $this->_itemCounter;
				// set the ajax options
					
				$ajax = isset($item['ajax']) ? $item['ajax'] : $this->ajax;
				$ajax_options = $ajax;
				if (isset($ajax['success']) == FALSE){
					if (isset($ajax['update']))
						$jquery_method = '$("' . $ajax['update'] . '").html(data);';
					elseif (isset($ajax['replace']))
					$jquery_method = '$("' . $ajax['replace'] . '").replaceWith(data);';
					else
						$jquery_method = NULL;
					$ajax_options['success'] =
					'js: function(data) { $("#' . $this->id . ' li").removeClass("' . $this->activeCssClass . '");
					$("#' . $item['linkOptions']['id'] . '").parent().addClass("' . $this->activeCssClass . '");' .
					$jquery_method . ' }';
				}
				// creates the ajax link. $item['linkOptions'] should come 2nd in the array_merge.
				$linkHtmlOptions = (isset($item['linkOptions']) ? array_merge(array('live'=>false), $item['linkOptions']) : array('live'=>false));
				return CHtml::ajaxLink($label, $item['url'], $ajax_options, $linkHtmlOptions);
					
			} else
				return CHtml::link($label, $item['url'], isset($item['linkOptions']) ? $item['linkOptions'] : array());
		}
		else
			return CHtml::tag('span', isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
	}

}