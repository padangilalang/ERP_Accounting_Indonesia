<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fAbsence extends CFormModel
{
	public $project_id;
	public $departemen_id;
	public $begindate;
	public $enddate;

	public function rules()
	{
		return array(
				// username and password are required
				//array('project_id, departemen_id, begindate, enddate', 'required'),
				array('begindate, enddate', 'type', 'type'=>'date', 'dateFormat'=>'yyyy-MM-dd'),
				array('project_id, departemen_id', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'project_id'=>'Project',
				'departemen_id'=>'Departemen',
				'begindate'=>'Begin Date',
				'enddate'=>'End Date',
		);
	}
}
