<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fImage extends CFormModel
{
	public $image;

	public function rules()
	{
		return array(
				// username and password are required
				array('image', 'required'),
				array('image', 'file', 'types'=>'jpg, gif, png'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'image'=>'Nama File Image',
		);
	}
}
