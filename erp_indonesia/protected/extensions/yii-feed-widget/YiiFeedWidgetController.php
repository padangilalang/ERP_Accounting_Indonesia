<?php
/**
 * FileDoc: 
 * Controller for YiiFeedWidget.
 * This extension depends on both idna convert and Simple Pie php libraries
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
 * Controller for YiiFeedWidget.
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
class YiiFeedWidgetController extends CExtController
{

    /**
     * Yii filters for controller
     * 
     * @return array - action filters
     */
    public function filters() 
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Rules for widget access
     * 
     * @return array - yii access rules array
     */
    public function accessRules() 
    {
        return array(
            array('allow',
                'actions' => array('GetFeed'),
                'users' => array('*'),
            )
        );
    }

    /**
     * (AJAX Action) 
     * Action to get feed and render it for an AJAX call.
     * 
     * @param string  $url   - url of the feed to process
     * @param integer $limit - how many items to grab from the feed
     * 
     * @return null; 
     */
    public function actionGetFeed($url, $limit) 
    {
        
        $feed = new SimplePie();

        // Set which feed to process.
        $feed->set_feed_url($url);

        //set the cache directory
        $feed->set_cache_location(
            Yii::getPathOfAlias(
                'ext.yii-feed-widget'
            ) . DIRECTORY_SEPARATOR . 'cache'
        );

        //$feed->set_item_limit(3);
        // Run SimplePie.
        $feed->init();

        // This makes sure that the content is sent to the browser as 
        // text/html and the UTF-8 character set (since we didn't change it).
        $feed->handle_content_type();

        $items = $feed->get_items(0, $limit);
        $this->renderPartial('ext.yii-feed-widget.views._YiiFeeds', array('items' => $items));
        
    }

}
