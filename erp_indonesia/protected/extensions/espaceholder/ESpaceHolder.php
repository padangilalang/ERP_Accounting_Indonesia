<?php
/**
 * ESpaceHolder.php
 * for more info visit http://placehold.it/
 *
 * @author Imre Mehesz <imehesz@gmail.com>
 * @link http://www.yiiframework.com/extension/espaceholder
 * @version $Id$
 * @package system
 */
class ESpaceHolder extends CWidget
{
	// size exapmles 50 or 50x20 etc
	public $size = 50;

	// colors can be fff or 006400 etc
	public $color;

	// text can be most charcters
	public $text;

	// whatever placehold.it support (default GIF)
	public $format;

	// used to collect all the settings
	public $settings;

	// used for the CHtml::image tag
	public $alt = '';
	public $htmlOptions = array();

	/**
	 * just puts together the settings file
	 */
	public function init()
	{
		$this->settings = array( $this->size, $this->color );
	}

	/**
	 * checks for the format and text and prints out a regilar
	 * CHtml
	 */
	public function run()
	{
		$format = $this->format ? '.' . $this->format : '';
		$text	= $this->text ? '&text=' . $this->text : '';

		echo
		CHtml::image(
				'http://placehold.it/' . implode( '/', $this->settings ) . $format . $text,
				$this->alt,
				$this->htmlOptions
		);
	}
}
