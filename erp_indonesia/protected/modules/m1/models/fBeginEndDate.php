<?php

class fBeginEndDate extends CFormModel
{
	public $begindate;
	public $enddate;


	public function rules()
	{
		return array(
				array('begindate, enddate', 'required'),
				array('begindate, enddate', 'type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'begindate'=>'Start Date',
				'enddate'=>'Finish Date',
		);
	}
}
