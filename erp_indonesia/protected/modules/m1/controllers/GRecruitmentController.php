<?php

class GRecruitmentController extends Controller
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
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$files = $this->read_folder_directory (Yii::app()->basePath."/../images/recruitment/".$id);

		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'files'=>$files,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new gRecruitment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['gRecruitment']))
		{
			$model->attributes=$_POST['gRecruitment'];
			$model->followup_id=1;
			$model->final_result_id=1;
				
			$model->image=CUploadedFile::getInstance($model,'image');
			$docs=CUploadedFile::getInstancesByName('docs');

			if (isset($model->image))
				$model->photo_path=$model->image->name;
				
			if($model->save()) {
				if (isset($model->image))
					$model->image->saveAs(Yii::app()->basePath . '/../images/recruitment/'.$model->image->name);

				if (isset($docs)) {
					mkdir(Yii::getPathOfAlias('webroot').'/images/recruitment/'.$model->id);
					//chmod(Yii::getPathOfAlias('webroot').'/images/recruitment/'.$model->id, 0755);
						
					foreach ($docs as $image => $pic) {
						$pic->saveAs(Yii::app()->basePath . '/../images/recruitment/'.$model->id . '/'.$pic->name);
					}
				}
					
					
				$this->redirect(array('/m1/gRecruitment'));
			}
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

		if(isset($_POST['gRecruitment']))
		{
			$model->attributes=$_POST['gRecruitment'];
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
	public function actionIndex($id=1)
	{
		$dataProvider=new CActiveDataProvider('gRecruitment');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'id'=>$id,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=gRecruitment::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='g-recruitment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionRecruitAutoComplete()
	{
		$res =array();
		if (isset($_GET['term'])) {
			$path=Yii::app()->homeUrl."/..";
			$qtxt ="SELECT candidate_name as label, DATE_FORMAT(birthdate,'%d-%m-%Y') as bdate, id, CONCAT('".$path."/images/recruitment/',photo_path) as ppath FROM g_recruitment WHERE candidate_name LIKE :name ORDER BY candidate_name LIMIT 5";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":name", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			//$res =$command->queryColumn();
			$res =$command->queryAll();

		}
		echo CJSON::encode($res);
	}

	private function read_folder_directory($dir = "root_dir/dir")
	{
		$listDir = array();
		if (is_dir($dir)) {
			if($handler = opendir($dir)) {
				while (($sub = readdir($handler)) !== FALSE) {
					if(is_file($dir."/".$sub)) {
						$listDir[] = $sub;
					}
				}
				closedir($handler);
			}
		}

		return $listDir;
	}

}
