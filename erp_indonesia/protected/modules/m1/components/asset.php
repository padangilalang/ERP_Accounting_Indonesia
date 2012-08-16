<?php

Yii::import('zii.widgets.CPortlet');

class asset extends CPortlet
{
	public function getRecentData()
	{
		$criteria = new cDbCriteria;
		$criteria->limit = 5;
		$criteria->order = 'updated_date DESC';

		return EaAsset::model()->findAll($criteria);
	}

	protected function renderContent()
	{
		$this->render('asset');
	}
}