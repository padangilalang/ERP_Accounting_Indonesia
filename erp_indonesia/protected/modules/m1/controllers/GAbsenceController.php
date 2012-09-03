<?php

class GAbsenceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'rights',
				'ajaxOnly + PersonAutoComplete',
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id,$month=0)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'month'=>$month,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new gPerson;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['gPerson']))
		{
			$model->attributes=$_POST['gPerson'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
				'model'=>$model,
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

		if(isset($_POST['gPerson']))
		{
			$model->attributes=$_POST['gPerson'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$model=new gPerson('search');
		$model->unsetAttributes();

		$criteria=new CDbCriteria;
		$criteria1=new CDbCriteria;

		if(isset($_GET['gPerson'])) {
			$model->attributes=$_GET['gPerson'];

			$criteria1->compare('vc_psnama',$_GET['gPerson']['vc_psnama'],true,'OR');
			//$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
		}

		$criteria->mergeWith($criteria1);

		$dataProvider=new CActiveDataProvider('gPerson', array(
				'criteria'=>$criteria,
		)
		);

		$this->render('index',array(
				'dataProvider'=>$dataProvider,
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
		$model=gPerson::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='g-person-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionPersonAutoComplete()
	{
		$res =array();
		if (isset($_GET['term'])) {
			$qtxt ="SELECT vc_psnama as name FROM g_person WHERE vc_psnama LIKE :name ORDER BY vc_psnama LIMIT 20";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":name", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			$res =$command->queryColumn();
			//$res =$command->queryAll();

		}
		echo CJSON::encode($res);
	}

}
