<?php

class SiteController extends Controller
{
	public $layout='//layouts/column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
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


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

		$model=new fLogin;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['fLogin']))
		{
			$model->attributes=$_POST['fLogin'];
			if($model->validate() && $model->login()) {

				sUser::model()->updateByPk((int)Yii::app()->user->id,array('last_login'=>time()));

				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		
		//flickr
		$tag="landscape";
		$tag = urlencode($tag);

		$api_key = "3febaac31cc6a34b93349523beacbfee";
		$per_page="11";
		$url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key={$api_key}&tags={$tag}&per_page={$per_page}";

		//$feed = getResource($url);
		if  (in_array  ('curl', get_loaded_extensions())) {
			$chandle = curl_init();
			curl_setopt($chandle, CURLOPT_URL, $url);
			curl_setopt($chandle, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($chandle);
			curl_close($chandle);

			$xml = simplexml_load_string($result);
		}  
  
		
		if  (Yii::app()->user->isGuest) {
			$this->render('login',array('model'=>$model,'xml'=>$xml));
		} else {
			$this->redirect(array('/menu'));
		}

	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
		$this->redirect(array('/site/login'));

	}

	// Facebook log in
	public function actionFacebooklogin() {
		Yii::import('ext.facebook.*');
		$ui = new FacebookUserIdentity('74026521543', '7f2ffd4bcdfafd919e276006223b4fd4');
		if ($ui->authenticate()) {
			$user=Yii::app()->user;
			$user->login($ui);
			$this->redirect($user->returnUrl);
		} else {
			throw new CHttpException(401, $ui->error);
		}
	}

}