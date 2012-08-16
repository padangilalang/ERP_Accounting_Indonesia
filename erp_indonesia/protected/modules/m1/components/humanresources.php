<?php

Yii::import('zii.widgets.CPortlet');

class humanresources extends CPortlet
{
	public function getRecentData()
	{
		$criteria = new cDbCriteria;
		$criteria->limit = 10;
		$criteria->order = 'updated_date DESC';

		return CPersonalia::model()->findAll($criteria);
	}

	protected function renderContent()
	{
		$this->render('humanresources');
	}
}