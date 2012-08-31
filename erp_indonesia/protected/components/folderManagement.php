<?php

Yii::import('zii.widgets.CPortlet');

class folderManagement extends CPortlet
{
	public function init()
	{
		//$this->title='Public Folder';
		parent::init();
	}

	protected function renderContent()
	{
		$this->render('folderManagement');
	}
}