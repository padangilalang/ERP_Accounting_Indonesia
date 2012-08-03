<?php

Yii::import('zii.widgets.CPortlet');

class siteSearch extends CPortlet
{
	public function init()
	{
		$this->title='Site Search';
		parent::init();
	}

	protected function renderContent()
	{
		$this->render('sitesearch');
	}
}