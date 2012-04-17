/**
 * Yii extension slidetoggle
 *
 * @author Joe Blocher <yii@myticket.at>
 * @copyright 2011 myticket it-solutions gmbh
 * @license New BSD License
 * @category User Interface
 * @version 1.1
 */

Make containers collapsible (fieldset,portlet,div,ul ...).
The extension uses the jQuery function 'slideToggle' to collapse/expand the containers.


##Requirements

Yii 1.1.6 or above


##Usage

- extract the files under .../protected/extensions

- Usage examples in the view


<?php

/**
 * 1. Fieldsets
 *
 * Default settings of the widget.
 * This will make all fieldsets collapsible, expanded per default.
 *
 * Note:
 * Better to use a single div as wrapper in the fieldset for all elements,
 * otherwise each child element will be toggled separately
 */

$this->widget('mongocms.extensions.slidetoggle.ESlidetoggle');


/**
 * 2. Standard Yii portlets
 */

$this->widget('ext.slidetoggle.ESlidetoggle',
array(
	'itemSelector' => '.portlet',
	'titleSelector' => '.portlet-decoration',
	//'collapsed' => '.portlet', //uncomment to show all closed
	'arrow' => false, //comment to show the toggle arrow
));


/**
 * 3. Custom div tags
 *
 * Note: The title must be a child of the collapsible div in the HTML code.
 */

$this->widget('ext.slidetoggle.ESlidetoggle',
array(
	'itemSelector' => 'div.collapsible',
	//only the second collapsible div with the class 'closed' is collapsed by default
	'collapsed' => 'div.collapsible.closed',
	'titleSelector' => 'div.collapsible h3',
));


/**
 * 4. Unordered lists
 *
 * Note:
 * Add the title as a child of the ul-tag in the HTML code.
 * Every li-tag will be toggled separately.
 */
$this->widget('ext.slidetoggle.ESlidetoggle',
array(
	'itemSelector' => 'ul.collapsible',
	'collapsed' => 'ul.collapsible',
	'titleSelector' => 'ul.collapsible .caption',
));

?>


<fieldset>
  <legend>The first fieldset</legend>
  <div>
    <label>Input</label>
    <input type="text"/>
    <label>Radio</label>
    <input type="radio"/>
  </div>
</fieldset>


<fieldset>
  <legend>The second fieldset</legend>
  <div>
    <label>Input</label>
    <input type="text"/>
    <label>Checbox</label>
    <input type="checkbox"/>
  </div>
</fieldset>



<div class="collapsible">
   <h3>Title 1</h3>
   <p>The first collapsible content</p>
</div>


<div class="collapsible closed">
   <h3>Title 2</h3>
   <p>The second collapsible content 2</p>
</div>


<ul class="collapsible">
 <span class="caption" style="margin-left:-1.5em;">Collapsible caption</span>
 <li>Item1</li>
 <li>Item2</li>
 <li>Item3</li>
</ul>

##Changelog

- v1.1

Added jQuery Easing plugin http://gsgd.co.uk/sandbox/jquery/easing/
for more easing methods.


##Similar extension

- yii-collapsible-fieldset
http://www.yiiframework.com/extension/yii-collapsible-fieldset/