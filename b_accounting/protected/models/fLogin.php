<?php

class fLogin extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	public $verifyCode;

	public function rules()
	{
		return array(
				array('username, password', 'required'),
				array('rememberMe', 'boolean'),
				array('password', 'authenticate'),
				array('username,password,verifyCode','required','on'=>'captchaRequired'),
                //array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),  
                array('verifyCode', 'captcha', 'allowEmpty'=>true),  				
		);
	}

	public function attributeLabels()
	{
		return array(
				'rememberMe'=>'Remember me',
		);
	}

	public function authenticate($attribute,$params)
	{
		$this->_identity=new UserIdentity($this->username,$this->password);
		if(!$this->_identity->authenticate())
			$this->addError('password','Incorrect username or password.');
	}

	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
