<?php

Yii::import('zii.widgets.CPortlet');

class Message extends CPortlet
{
	private function newNotification()
	{
		$model=new sNotification;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sNotification']))
		{
			$model->attributes=$_POST['sNotification'];
			$model->sender_id=Yii::app()->user->id;
			$model->type_id=2;
			$model->read_id=1;
			$model->category_id=12;
			if($model->save()) {
				Yii::app()->user->setFlash('success','Data berhasil disimpan');
				$this->refresh();
			}
		}

		return $model;

	}

	private function newNotification3()   //type_id = 3 ; Custom Message. category_id = 50 ; Custom Message
	{
		$model=new sNotification3;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sNotification3']))
		{
			$model->attributes=$_POST['sNotification3'];
			$model->sender_id=Yii::app()->user->id;
			$model->type_id=3;
			$model->read_id=1;
			$model->receiver_id=1;
			//$model->category_id=50;
			if($model->save())
				$this->refresh();
		}

		return $model;

	}

	protected function renderContent()
	{
		/*
		 1 = Admin Message
		2 = User Message
		3 = Allocation Custom Message



		*/


		$model=$this->newNotification();
		$model3=$this->newNotification3();


		$dataProvider=sNotification::model()->searchFilter();
		$dataProvider3=sNotification3::model()->searchFilter3();


		$this->render('message',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
				'dataProvider3'=>$dataProvider3,
				'model3'=>$model3,
		));
	}


}
