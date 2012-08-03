<?php

Yii::import('zii.widgets.CPortlet');

class favouritemenu extends CPortlet
{
	public function getRecentData()
	{
		$criteria = new cDbCriteria;
		$criteria->limit = 10;
		$criteria->compare('s_user_id',Yii::app()->user->id);
		$criteria->compare('favourite_id','1');

		return SUserModule::model()->findAll($criteria);
	}

	protected function renderContent()
	{
		$this->render('favouritemenu');
	}
}