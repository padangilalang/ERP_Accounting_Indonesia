<?php
/**
 * FileDoc: 
 * View Partial for YiiFeedWidget.
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
foreach ($items as $item):
?>
<div class="yii-feed-widget-item">
    <h2><a href="<?php echo $item->get_permalink(); ?>">
            <?php echo $item->get_title(); ?></a>
    </h2>
    <p><small>Posted on <?php echo $item->get_date('j F Y | g:i a'); ?></small></p>
    <p><?php echo $item->get_description(); ?></p>
</div>
<?php endforeach; ?>
<div class="yii-feed-widget-clear"></div>