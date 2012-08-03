<?php

Yii::import('zii.widgets.CPortlet');

class Communication extends CPortlet
{
	protected function renderContent()
	{
		$this->render('communication');
	}
}