<?php

Yii::import('zii.widgets.CPortlet');

class treeviewBudget extends CPortlet
{
	public function init()
	{
		//$this->title='Tree Budget';
		parent::init();
	}

	public function getId()
	{
		$value = 1;

		foreach ($_GET as $key => $val)
			if ($key == 'id')
			return $val;

		return $value;
	}

	protected function renderContent()
	{
		$getId=$this->getId();

		$this->render('treeviewBudget',array(
				'getId'=>$getId,
		));
	}
}