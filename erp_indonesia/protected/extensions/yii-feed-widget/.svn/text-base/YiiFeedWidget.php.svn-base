<?php 
/**
 * FileDoc: 
 * Widget for YiiFeedWidget.
 * This extension depends on both idna convert and Simple Pie php libraries
 *  
 * Usage:
 * 
 * 1. Copy the files into the extensions directory
 * 
 * 2. In your main site config file you must add an entry in controllerMap
 * 'controllerMap'=>array(
 *      'YiiFeedWidget' => 'ext.yii-feed-widget.YiiFeedWidgetController'
 * ),
 * 
 * 3. Use the widget in a view specifying the url of the feed to grab and
 * the number of items to grab from the feed. (0 for all items)
 * 
 * eg.
 * <!-- Feed widget -->
 * <?php 
 * $this->widget(
 *    'ext.yii-feed-widget.YiiFeedWidget',
 *    array('url'=>'http://www.mysite.com/feed','limit'=>3)
 * ); 
 * ?>
 * 
 * PHP version 5.3
 * 
 * @category Extensions
 * @package  YiiFeedWidget
 * @author   Richard Walker <richie@mediasuite.co.nz>
 * @license  BSD License http://www.opensource.org/licenses/bsd-license.php
 * @link     http://mediasuite.co.nz
 * @see      simplepie.org
 * @see      http://www.phpclasses.org/browse/file/5845.html
 * 
 */ 
Yii::import('ext.yii-feed-widget.*');

/**
 * ClassDoc:
 * Widget for YiiFeedWidget.
 * This extension depends on both idna convert and Simple Pie php libraries
 *  
 * PHP version 5.3
 * 
 * @category Extensions
 * @package  YiiFeedWidget
 * @author   Richard Walker <richie@mediasuite.co.nz>
 * @license  http://mediasuite.co.nz Mediasuite
 * @link     http://mediasuite.co.nz
 * @see      simplepie.org
 * @see      http://www.phpclasses.org/browse/file/5845.html
 * 
 */ 
class YiiFeedWidget extends CWidget
{

    /** 
     * @var string $url  - The url of the feed 
     */
    public $url;
    
    /**
     * @var integer $limit - Number of items to parse. 0 for all.
     */
    public $limit;
    
    /**
     * @var string $_assetsUrl - The published url location where assets for
     * this widget can be linked to
     */
    private $_assetsUrl;
    
    /**
     * Tries to gets the user specified feed url. If the user has not specified
     * the feed when calling the widget, we check the yii config file in the 
     * params array for a yii-feed-widget-url. If this is not specified as well
     * then we throw and exception
     * 
     * @return string url of feed being read
     * @throws CException 
     */
    public function getFeedUrl() 
    {
        if (is_null($this->url)) {
            if (isset(Yii::app()->params['yii-feed-widget-url'])) {
                return Yii::app()->params['yii-feed-widget-url'];
            }
            $error = 'No feed specified for reading. '.
                    'Please specify an absolute feed url.';
            throw new CException($error);
        }
        return $this->url;
    }
    
    /**
     * Checks if widget user has set required item count at run time.
     * if not sets to 0 (all)
     * 
     * @return integer - required number of items 
     */
    public function getRequiredItemCount()
    {
        if (is_null($this->limit)) {
            $this->requiredItemCount = 0;
        }
        return $this->limit;
    }
    
    /**
     * Registers a given script file from the assets directory.
     * 
     * @param string $script - the script filename to be registered
     * 
     * @return null 
     */
    public function registerClientScript($script)
    {
        // publish CSS or JavaScript files
        Yii::app()->clientScript->registerCoreScript('jquery');
        $clientScript = Yii::app()->clientScript;
        $clientScript->registerScriptFile(
            $this->_getAssetsUrl().DIRECTORY_SEPARATOR.'js'
            .DIRECTORY_SEPARATOR.$script,
            CClientScript::POS_END
        );
    }

    /**
     * Registers a given css file from the extension assets directory
     * 
     * @param string $css - css file to register
     * 
     * @return null
     */
    public function registerClientCSS($css)
    {
        $clientCSS = Yii::app()->clientScript;
        $clientCSS->registerCssFile(
            $this->_getAssetsUrl().DIRECTORY_SEPARATOR.'css'
            .DIRECTORY_SEPARATOR.$css,
            CClientScript::POS_HEAD
        );
    }
    
    /**
     * Returns a url string of an ajax spinner for use when the widget starts
     * up and is waiting for the AJAX call to return.
     * 
     * @return string - the url of the ajax spinner
     */
    public function getSpinner()
    {
        return $this->_getAssetsUrl() . DIRECTORY_SEPARATOR . 
            'images' . DIRECTORY_SEPARATOR . 'spinner.gif';
    }
    
    /**
     * Returns the published url for this widgets assets. Will publish the 
     * assets if they are not already published
     * 
     * @return string
     */
    private function _getAssetsUrl()
    {
        if (is_null($this->_assetsUrl)) {
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('ext.yii-feed-widget.assets')
            );
        }
        return $this->_assetsUrl;
    }
    
    
    /**
     * Widget instantiation. Creates the widget
     * 
     * @return null
     */
    public function run() 
    {
        //get params
        $feedUrl = $this->getFeedUrl();
        $requiredItemCount = $this->getRequiredItemCount();
        //render feed items in the widget container
        $this->render(
            'YiiFeedWidget',
            array(
                'url'=>$feedUrl, 
                'limit'=>$requiredItemCount
            )
        );
    }

}