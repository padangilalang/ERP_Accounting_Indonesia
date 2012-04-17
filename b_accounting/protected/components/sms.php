<?php

Yii::import('zii.widgets.CPortlet');

class sms extends CPortlet
{
	public function init()
	{
		$this->title='SMS';
		parent::init();
	}

	protected function renderContent()
	{
		$this->render('sms');
	}
}