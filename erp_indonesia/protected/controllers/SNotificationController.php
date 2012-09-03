<?php

class SNotificationController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
				'rights',
		);
	}

	public function actionView($id)
	{
		$comments=$this->newComment($id);

		$model = $this->loadModel($id);
		if ($model->receiver_id == Yii::app()->user->id)
			$model->saveCounters(array('read_id'=>1));

		$this->render('view',array(
				'model' => $model,
				'comments' => $comments,
		));
	}

	protected function newComment($id)
	{
		$snotif=new sNotificationDetail;

		if(isset($_POST['sNotificationDetail']))
		{
			$snotif->attributes=$_POST['sNotificationDetail'];
			$snotif->parent_id=$id;
			$snotif->save();
			Yii::app()->user->setFlash('success','Komen terkirim');
			Yii::app()->user->setFlash('success','<strong>Great!</strong> Comment has sent..');
			$this->refresh();

		}
		return $snotif;
	}

	public function actionCreate()
	{
		$model=new sNotification;

		// $this->performAjaxValidation($model);

		if(isset($_POST['sNotification']))
		{
			$model->attributes=$_POST['sNotification'];
			if (Yii::app()->user->name !='admin')
				$model->type_id = 2;
			/*
			 1 = Admin Message
			2 = User Message
			3 = Allocation Custom Message

			*/
			if ($model->sender_ref ==null)
				$model->sender_ref=Yii::app()->user->name.' / '.$model->receiver;

			if($model->save()) {
				Yii::app()->user->setFlash('success','<strong>Great!</strong> Your message has been sent successfully');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// $this->performAjaxValidation($model);

		if(isset($_POST['sNotification']))
		{
			$model->attributes=$_POST['sNotification'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','<strong>Great!</strong> data has been saved successfully');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('sNotification',array('criteria'=>array('order'=>'sender_date DESC')));
		$dataProviderMySelf=new CActiveDataProvider('sNotification',array('criteria'=>array(
				'condition'=>'receiver_id = :receiver',
				'params'=>array(':receiver'=>Yii::app()->user->id),
				'order'=>'sender_date DESC')));

		$this->render('index',array(
				'dataProviderMySelf'=>$dataProviderMySelf,
				'dataProvider'=>$dataProvider,
		));
	}

	public function loadModel($id)
	{
		$model=sNotification::model()->findByPk((int)$id);

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sNotification-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionMarkRead($id)
	{
		//$model=sNotification::model()->findByPk((int)$id);
		$model=sNotification::model()->findByPk((int)$id, array('condition'=>'receiver_id = '. Yii::app()->user->id ));

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$model->read_id=4;
		$model->receiver_date=time();
		$model->save();

		$this->redirect(Yii::app()->user->returnUrl);



	}

	public function actionMarkArchive($id)
	{
		$model=sNotification::model()->findByPk((int)$id, array(
				'condition'=>'sender_id = :sender',
				'params'=>array(':sender'=>Yii::app()->user->id),
		));

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$model->read_id=6;
		$model->archive_date=time();
		$model->save();

		$this->redirect(Yii::app()->user->returnUrl);



	}

	public function actionMarkHide($id)
	{
		$model=sNotification::model()->findByPk((int)$id);

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$model->read_id=6;
		$model->archive_date=time();
		$model->save();

		$this->redirect(array('admin'));
	}


}
