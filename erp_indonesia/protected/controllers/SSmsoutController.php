<?php

class SSmsoutController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				//'accessControl', // perform access control for CRUD operations
				'rights',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sSmsout']))
		{
			$model->attributes=$_POST['sSmsout'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$smsout= $this->newSmsout();

		$dataProvider=new CActiveDataProvider('sSmsout', array(
				'criteria'=>array(
						'order'=>'created_date DESC',
				),
		));

		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'modelSmsout'=>$smsout,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function newSmsout()
	{
		$model=new sSmsout;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sSmsout']))
		{

			//Save to Log File
			$model->attributes=$_POST['sSmsout'];
			$model->created_date=time();
			$model->sender_id =Yii::app()->user->id;
			$model->save();

			//Create Send SMS File
			$models=dAddressbookGroupDetail::model()->findAll(array(
					'condition'=>'parent_id = :parent',
					'params'=>array(':parent'=>$model->receivergroup_id),
			));

			foreach ($models as $model1) :
			$_rand=mt_rand(100,999);
			$myfile = $model->id."-".$_rand."-".dAddressbook::model()->findByPk($model1->name_id)->complete_name. ".txt";
			$fh = fopen("C:\\wamp\\apps\\sms\\outgoing\\".$myfile, "w")
			or die("can't open file");
			$stringData = "To: " .dAddressbook::model()->findByPk($model1->name_id)->handphone ."\n";
			fwrite($fh, $stringData);
			$stringData = "\n";
			fwrite($fh, $stringData);
			$stringData = $model->message;
			fwrite($fh, $stringData);
			fclose($fh);
			endforeach;


			$this->redirect(array('/sSmsout'));
		}

		return $model;
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new sSmsout('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['sSmsout']))
			$model->attributes=$_GET['sSmsout'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=sSmsout::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ssmsout-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
