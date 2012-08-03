<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fSms extends CFormModel
{
	public $hp;
	public $message;

	public function rules()
	{
		return array(
				// username and password are required
				array('hp, message', 'required'),
				array('message', 'length', 'max'=>480),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'hp'=>'No HP',
				'm'=>'Message',
		);
	}
}
