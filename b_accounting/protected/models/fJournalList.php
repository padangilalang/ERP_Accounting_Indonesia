<?php

class fJournalList extends CFormModel
{
	public $begindate;
	public $enddate;
	public $account_no_id;
	public $type_report_id;

	public function rules()
	{
		return array(
				array('account_no_id, begindate, enddate', 'required'),
				array('begindate, enddate', 'type', 'type'=>'date', 'dateFormat'=>'dd-MM-yyyy'),
				array('account_no_id, type_report_id', 'numerical', 'integerOnly'=>true),
		);
	}

	public function attributeLabels()
	{
		return array(
				'begindate'=>'Periode Mulai',
				'enddate'=>'Periode Selesai',
				'account_no_id'=>'Account No',
				'type_report_id'=>'Report Type',
		);
	}

}
