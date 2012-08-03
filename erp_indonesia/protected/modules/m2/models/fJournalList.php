<?php

class fJournalList extends CFormModel
{
	public $begindate;
	public $enddate;
	public $account_no_id;
	public $type_report_id;
	public $post_id;

	public function rules()
	{
		return array(
				array('begindate, enddate', 'required'),
				array('begindate, enddate', 'type', 'type'=>'date', 'dateFormat'=>'dd-MM-yyyy'),
				array('account_no_id, type_report_id, post_id', 'numerical', 'integerOnly'=>true),
				array('enddate','compare','compareAttribute'=>'begindate',
						'operator'=>'>', 'allowEmpty'=>true ,
						'message'=>'{attribute} must more than "{compareValue}".'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'begindate'=>'Start Date',
				'enddate'=>'End Date',
				'account_no_id'=>'Account No',
				'type_report_id'=>'Report Type',
				'post_id'=>'Post Status',
		);
	}

}
