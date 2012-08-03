<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fUltah extends CFormModel
{
	public $module;
	public $bulan;

	public function rules()
	{
		return array(
				// username and password are required
				array('module, bulan', 'required'),
				//array('begindate, enddate', 'type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd'),
				array('bulan', 'numerical', 'integerOnly'=>true),
				array('bulan', 'length', 'max'=>15),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'module'=>'Nama Module',
				'bulan'=>'Nama Bulan',
		);
	}
}
