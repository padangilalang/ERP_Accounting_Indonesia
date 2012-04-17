<?php

class fSqlStatement extends CFormModel
{
	public $sql;

	public function rules()
	{
		return array(
				array('sql', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'sql'=>'SQL Statement',
		);
	}
}