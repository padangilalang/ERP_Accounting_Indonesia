<?php

Yii::import('zii.widgets.CPortlet');

class budget extends CPortlet
{
	public function getRecentData()
	{
		$criteria = new cDbCriteria;
		$criteria->limit = 5;
		$criteria->order = 'updated_date DESC';
		$criteria->compare('payment_state_id',3);
		$criteria->condition = 'approved_date is null';

		return APrequest::model()->findAll($criteria);
	}

	protected function renderContent()
	{
		$this->render('budget');
	}
}