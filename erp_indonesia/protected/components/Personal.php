<?php

Yii::import('zii.widgets.CPortlet');

class Personal extends CPortlet
{
	public function init()
	{
		$this->title='Personal Notification';
		parent::init();
	}

	protected function renderContent()
	{
		$this->render('personal');
	}
}