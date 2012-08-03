<?php

Yii::import('zii.widgets.CPortlet');

class treeViewAccount extends CPortlet
{
	public function init()
	{
		//$this->title='Tree View Account';
		parent::init();
	}

	protected function renderContent()
	{
		$this->render('treeViewAccount');
	}
}