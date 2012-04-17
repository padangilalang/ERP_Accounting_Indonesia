<?php

class SiteController extends Controller
{
	public $layout='//layouts/column1';

	public function actions()
	{
		return array(
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	public function actionLogin()
	{
		$model=new fLogin;

		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['fLogin']))
		{
			$model->attributes=$_POST['fLogin'];
			if($model->validate() && $model->login()) {

				//Save Last Login
				$model1=sUser::model()->findByPk((int)Yii::app()->user->id);
				if($model1 != null) {
					$model1->last_login=time();
					$model1->save();
				}
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		if  (Yii::app()->user->isGuest) {
			$this->render('login',array('model'=>$model));
		} else {
			$this->redirect(array('/menu'));
		}

	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
		$this->redirect(array('/site/login'));

	}
}