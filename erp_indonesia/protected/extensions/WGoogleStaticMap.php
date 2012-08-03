<?php
/**
 * Widget to display a Google Static image
 * @author Alex Muir
 *
 * Usage
 * <code>
 * <? $this->widget('application.components.widgets.WGoogleStaticMap',array(
 *				'center'=>'52.3214,2.34403',
 *				'alt'=>"Map for location of something", // Alt text for image
 *				'zoom'=>0, // Google map zoom level
 *				'width'=>150, // image width
 *				'height'=>150, // image Height
 *				'markers'=>array(
 *					array(
 *						'style'=>array('color'=>'green'),
 *						'locations'=>array('London, UK','San Francisco, US'),
 *					),
 *					array(
 *						'style'=>array('color'=>'blue','label'=>'X'),
 *						'locations'=>array('52.433432,-5.34322'),
 *					),
 *				),
 *				'linkUrl'=>array('location/view'), // Where the image should link
 *				'linkOptions'=>array('target'=>'_blank'), // HTML options for link tag
 *				'imageOptions'=>array('class'=>'map-image'), // HTML options for img tag
 *			)); ?>
 *
 * </code>
 */
class WGoogleStaticMap extends CWidget {
	/**
	 * HTML options for the image tag
	 * @var array
	 */
	public $imageOptions;

	/**
	 * Alt text to be displayed for image
	 * @var string
	 */
	public $alt = 'Google Map';

	/**
	 *
	 * @var string Centre of map Eg. 52.32132,42.3212321, or string.
	 */
	public $center = null;

	/**
	 * @var int Zoom level (0 is whole world)
	 */
	public $zoom = null;

	/**
	 * @var string Whether this device has a sensor(!?!)
	 */
	public $sensor = 'false';

	/**
	 * @var int width of image in pixels (used in img tag too)
	 */
	public $width = null;

	/**
	 * @var int height of image in pixels
	 */
	public $height = null;

	/**
	 * Possible attributes for each marker:
	 * -style
	 *		- size {tiny,mid,small}
	 *		- color: {color=0xFFFFCC or name}
	 *		- label: {alphanumeric-character
	 *		- icon: Url to icon images
	 *		- shadow: default true (should Google make a shadow)
	 * - locations (array of text locations)
	 * @var array holds an array of markers
	 */
	public $markers = array();


	/**
	 * HTML options for link tag
	 * @var array
	 */
	public $linkOptions = array();

	/**
	 * Route to link image to
	 * @var mixed
	 */
	public $linkUrl = null;


	private $_baseUrl = 'http://maps.google.com/maps/api/staticmap?';



	public function init()
	{
		if (is_null($this->center))
			throw new CHttpException('No center supplied for static Google Map image');

		if (is_null($this->width) || is_null($this->height))
			throw new CHttpException('No size specified for static Google Map image');
	}

	public function run()
	{
		$url = $this->createImageUrl();

		// Deal with image size
		$this->imageOptions['width'] = $this->width;
		$this->imageOptions['height'] = $this->height;

		if (is_null($this->linkUrl))
		{
			echo CHtml::image($url,$this->alt,$this->imageOptions);
		} else
		{
			echo CHtml::link(CHtml::image($url,$this->alt,$this->imageOptions),$this->linkUrl,$this->linkOptions);
		}

	}

	/**
	 *
	 * @return string URL for map image
	 */
	public function createImageUrl ()
	{
		$url = $this->_baseUrl;
		$url .= 'center='.urlencode($this->center);
		$url .= "&size={$this->width}x{$this->height}";

		$url .= $this->resolveMarkers();

		if (!is_null($this->zoom))
			$url .= '&zoom='.$this->zoom;

		$url .= '&sensor='.(string)$this->sensor;
		return $url;
	}

	/**
	 *
	 * @return string Creates part of URL that deals with markers
	 */
	public function resolveMarkers()
	{
		$url = '';

		foreach ($this->markers as $marker)
		{
			$markerUrl = '';
			if (isset($marker['style']))
			{
				foreach ($marker['style'] as $style=>$value)
				{
					$markerUrl .= $style.':'.$value.'|';
				}
			}

			foreach ($marker['locations'] as $location)
			{
				$markerUrl .= urlencode($location).'|';
			}

			// Chop off the last |
			$markerUrl = rtrim($markerUrl,'|');
			$url .= '&markers='.$markerUrl;
		}

		return $url;
	}
}
?>
