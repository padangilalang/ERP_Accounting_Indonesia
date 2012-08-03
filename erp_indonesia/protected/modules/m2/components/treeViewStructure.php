<?php

Yii::import('zii.widgets.CPortlet');

class treeViewStructure extends CPortlet
{
	public function init()
	{
		//$this->title='Tree View Structure';
		parent::init();
	}

	protected function renderContent()
	{
		$this->render('treeViewStructure');
	}
}