<?php

Yii::import('zii.widgets.CPortlet');

class notificationSystem extends CPortlet
{
	public $title='Notification System';
	public $limit=5;

	public function getRecentData1($id)
	{
		return SNotification::model()->findAll(array('condition'=>'category_id = '.$id ,'order'=>'sender_date DESC','limit'=>7));
	}

	public function getRecentCat()
	{
		return SNotification::model()->findAllBySql('select category_id
				from s_notification
				where type_id = 1
				group by category_id
				limit 7' );

	}

	protected function renderDecoration()
	{
		if($this->title!==null)
		{
			//echo "<div class=\"{$this->decorationCssClass}\">\n";
			//echo "<div class=\"{$this->titleCssClass}\">{$this->title}</div>\n";
			//echo "</div>\n";
		}
	}

	protected function renderContent()
	{
		$this->render('notificationsystem');
	}

}