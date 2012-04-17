<?php
Yii::import('zii.widgets.CPortlet');

class CPortletUI extends CPortlet
{
	/**
	 * @var string the CSS class for the decoration container tag. Defaults to 'portlet-decoration'.
	 */
	public $decorationCssClass='portlet-decoration ui-widget-header ui-corner-top';
	/**
	 * @var string the CSS class for the content container tag. Defaults to 'portlet-content'.
	 */
	public $contentCssClass='portlet-content ui-widget-content ui-corner-bottom';

}