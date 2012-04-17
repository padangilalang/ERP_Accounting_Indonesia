<?php

class fEmail extends CFormModel
{
	public $name;
	public $username;
	public $receiver;
	public $email;
	public $useremail;
	public $subject;
	public $body;
	public $verifyCode;

	public function rules()
	{
		return array(
				array('subject, body', 'required'),
				array('email,useremail', 'email'),
				array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
		);
	}

	public function attributeLabels()
	{
		return array(
				'username'=>'User Name',
				'useremail'=>'Email User',
				'receiver'=>'Receiver',
				'verifyCode'=>'Verification Code',
		);
	}
}