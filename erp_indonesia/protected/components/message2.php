<?php

Yii::import('zii.widgets.CPortlet');

class Message2 extends CPortlet
{
	protected function renderContent()
	{
		$this->render('message2');
	}
}