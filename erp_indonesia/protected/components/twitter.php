<?php

Yii::import('zii.widgets.CPortlet');

class Twitter extends CPortlet
{
	protected function renderContent()
	{
		$this->render('twitter');
	}
}