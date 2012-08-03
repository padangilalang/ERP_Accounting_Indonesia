<?php

class fReport extends CFormModel
{
	public $periode_date;
	public $report_id;

	public function rules()
	{
		return array(
				array('periode_date, report_id', 'required'),
				array('periode_date, report_id', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'periode_date'=>'Periode Date',
				'report_id'=>'Report',
		);
	}
}
