<?php

Yii::import('zii.widgets.CPortlet');

class notificationPersonal extends CPortlet
{
	protected function renderContent()
	{
		$this->render('notificationpersonal');
	}
}