<?php

class SUserController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
				'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
				array('allow',
						'users'=>array('admin'),
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}

	public function actionView($id)
	{
		$module=$this->newUserModule($id);
		$group=$this->newUserGroup($id);

		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'modelModule'=>$module,
				'modelGroup'=>$group,
		));
	}

	public function newUser()
	{
		$model=new sUser;
		$model->setScenario('password');

		//$this->performAjaxValidation($model);

		if(isset($_POST['sUser']))
		{
			$model->attributes=$_POST['sUser'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','<strong>Great!</strong> data has been saved successfully');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		return $model;
	}

	public function newUserModule($id)
	{
		$model=new sUserModule();

		if(isset($_POST['sUserModule']))
		{
			$model->attributes = $_POST['sUserModule'];
			if (is_array(@$_POST['sUserModule']['s_module_id'])) {

				foreach ($_POST['sUserModule']['s_module_id'] as $item) {
					$model=new sUserModule();
					$model->s_user_id = $id;
					$model->s_module_id = $item;
					$model->s_matrix_id = $_POST['sUserModule']['s_matrix_id'];
					$model->save();
				}
				$this->refresh();
			}

		}

		return $model;
	}

	public function newUserGroup($id)
	{
		$model=new sGroup();

		if(isset($_POST['sGroup']))
		{
			$model->attributes = $_POST['sGroup'];
			$model->parent_id = $id;
			$model->save();
			//$this->refresh();
			$this->redirect(array('view','id'=>$id,'#'=>'yw3_tab_2'));

		}

		return $model;
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// $this->performAjaxValidation($model);

		if(isset($_POST['sUser']))
		{
			$model->attributes=$_POST['sUser'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','<strong>Great!</strong> data has been saved successfully');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	public function actionUpdatePassword($id)
	{
		$model=$this->loadModel($id);
		$model->setScenario('password');

		$this->performAjaxValidation($model);

		if(isset($_POST['sUser']))
		{
			$model->attributes=$_POST['sUser'];

			$_mysalt=sUser::model()->generateSalt();
			$model->salt=$_mysalt;

			if($model->validate()) {
				$model->password = md5($_mysalt . $model->password);
				$model->save();
				
				Yii::app()->user->setFlash('success','<strong>Great!</strong> data has been saved successfully');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('updatePassword',array(
				'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		$command=Yii::app()->db->createCommand('delete from s_user_module where s_user_id ='.$id);
		$command->execute();

		$this->redirect(array('/sUser'));
	}


	public function actionIndex()
	{
		$user=$this->newUser();

		$model=new sUser('search');
		$model->unsetAttributes();
		if(isset($_GET['sUser']))
			$model->attributes=$_GET['sUser'];

		$this->render('index',array(
				'model'=>$model,
				'modeluser'=>$user,
		));
	}

	public function loadModel($id)
	{
		$model=sUser::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpdateModule($id,$s_user_id)
	{
		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$model1=$this->loadModel1($id);

		// $this->performAjaxValidation($model);

		if(isset($_POST['sUserModule']))
		{
			$model1->attributes=$_POST['sUserModule'];
			if($model1->save()) {
				Yii::app()->user->setFlash('success','<strong>Great!</strong> data has been saved successfully');
				$this->redirect(array('view','id'=>$s_user_id));
			}
		}

		$this->render('updateModule',array(
				'model'=>$model1,
				'sid'=>$s_user_id,
		));
	}

	public function loadModelUserModule($id)
	{
		$model=sUserModule::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionDeleteModule($id)
	{
		$_mid=$this->loadModelUserModule($id)->s_user_id;
		$this->loadModelUserModule($id)->delete();
		$this->redirect(array('view','id'=>$_mid));
	}

	public function loadModelUserGroup($id)
	{
		$model=sGroup::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionDeleteGroup($id)
	{
		$_mid=$this->loadModelUserGroup($id)->parent_id;
		$this->loadModelUserGroup($id)->delete();
		$this->redirect(array('view','id'=>$_mid));
	}
}
