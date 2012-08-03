<?php

Yii::import('zii.widgets.CPortlet');

class Notification extends CPortlet
{
	public $title='Notification Box';
	public $limit=5;

	public function getRecentData1($id)
	{
		return SNotification::model()->findRecent1($this->limit,$id);
	}

	public function getRecentCat()
	{
		return SNotification::model()->findRecentCat();
	}

	protected function renderContent()
	{
		$this->render('notification');
	}
}