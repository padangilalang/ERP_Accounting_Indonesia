<?php

class fSms extends CFormModel
{
	public $hp;
	public $message;

	public function rules()
	{
		return array(
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
