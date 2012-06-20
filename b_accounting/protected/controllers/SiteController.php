<?php

class SiteController extends Controller
{
	public $layout='//layouts/column1';
	
	public $attempts = 5; // allowed 5 attempts
	public $counter;
	
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

	private function captchaRequired()
	{           
		return Yii::app()->session->itemAt('captchaRequired') >= $this->attempts;
	}
	
	public function actionLogin()
	{
		//$model=new fLogin;
		$model = $this->captchaRequired()? new fLogin('captchaRequired') : new fLogin;

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
				sUser::model()->updateByPk((int)Yii::app()->user->id,array('last_login'=>time()));
				
				$this->redirect(Yii::app()->user->returnUrl);
			} else {
				$this->counter = Yii::app()->session->itemAt('captchaRequired') + 1;
				Yii::app()->session->add('captchaRequired',$this->counter);			
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