<?php

Yii::import('zii.widgets.CPortlet');

class Personalization extends CPortlet
{
	public function init()
	{
		//$this->title='Personalization';
		parent::init();
	}

	protected function renderContent()
	{
		$this->render('personalization');
	}
}