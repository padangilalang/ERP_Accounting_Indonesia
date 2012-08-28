<?php

class aBudgetController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			array(
				'COutputCache +index',
				// will expire in a year
				'duration'=>24*3600*365,
				'dependency'=>array(
				'class'=>'CChainedCacheDependency',
				'dependencies'=>array(
					new CGlobalStateCacheDependency('budget'),
					new CDbCacheDependency('SELECT id FROM a_budget
					ORDER BY id DESC LIMIT 1'),
					),
				),
			),
		);
	}
	/**/
	
	/**
	 * @return array action filters
	 */
/*	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}
*/

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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new aBudget;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['aBudget']))
		{
			$model->attributes=$_POST['aBudget'];
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

		if(isset($_POST['aBudget']))
		{
			$model->attributes=$_POST['aBudget'];
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
	public function actionIndex($id=300,$pro_id=1)
	{
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('_component',array(
					'id'=>$id,
					'pro_id'=>$pro_id,
			));
		} else {
			$this->render('index',array(
					'id'=>$id,
					'pro_id'=>$pro_id,
			));
		}

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=aBudget::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='abudget-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAjaxFillTreeCP()
	{
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		$parentId = 0;
		if (isset($_GET['root']) && $_GET['root'] !== 'source') {
			$parentId = (int) $_GET['root'];
		}

		$req = Yii::app()->db->createCommand(
				"SELECT m1.id, m1.name AS text, m2.id IS NOT NULL AS hasChildren "
				. "FROM a_budget AS m1 LEFT JOIN a_budget AS m2 ON m1.id=m2.parent_id "
				. "WHERE m1.department_id = 1 AND m1.parent_id <=> $parentId "
				. "GROUP BY m1.id ORDER BY m1.code ASC"
		);
		$children = $req->queryAll();

		$treedata=array();
		foreach($children as $child){
			$options=array('href'=>Yii::app()->createUrl('aBudget/index',array('id'=>$child['id'])),'id'=>$child['id'],'class'=>'treenode');
			$nodeText = CHtml::openTag('a', $options);
			$nodeText.= $child['text'];
			$nodeText.= CHtml::closeTag('a')."\n";
			$child['text'] = $nodeText;
			$treedata[]=$child;
		}
		//$children = $this->createLinks($children);

		echo str_replace(
				'"hasChildren":"0"',
				'"hasChildren":false',
				//CTreeView::saveDataAsJson($children)
				CTreeView::saveDataAsJson($treedata)
		);
		exit();
	}

	public function actionAjaxFillTreeRMG()
	{
		if (!Yii::app()->request->isAjaxRequest) {
			exit();
		}
		$parentId = 0;
		if (isset($_GET['root']) && $_GET['root'] !== 'source') {
			$parentId = (int) $_GET['root'];
		}

		$req = Yii::app()->db->createCommand(
				"SELECT m1.id, m1.name AS text, m2.id IS NOT NULL AS hasChildren "
				. "FROM a_budget AS m1 LEFT JOIN a_budget AS m2 ON m1.id=m2.parent_id "
				. "WHERE m1.department_id = 2 AND m1.parent_id <=> $parentId "
				. "GROUP BY m1.id ORDER BY m1.code ASC"
		);
		$children = $req->queryAll();

		$treedata=array();
		foreach($children as $child){
			$options=array('href'=>Yii::app()->createUrl('aBudget/index',array('id'=>$child['id'],'pro_id'=>2)),'id'=>$child['id'],'class'=>'treenode');
			$nodeText = CHtml::openTag('a', $options);
			$nodeText.= $child['text'];
			$nodeText.= CHtml::closeTag('a')."\n";
			$child['text'] = $nodeText;
			$treedata[]=$child;
		}
		//$children = $this->createLinks($children);

		echo str_replace(
				'"hasChildren":"0"',
				'"hasChildren":false',
				//CTreeView::saveDataAsJson($children)
				CTreeView::saveDataAsJson($treedata)
		);
		exit();
	}

	public function actionReport1($id,$pro_id=1)
	{
		$pdf=new aBudgetPosition1('P','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$pdf->report($id,$pro_id);
			
		$pdf->Output();

	}

	public function actionReport2($id,$pro_id=1)
	{
		$pdf=new aBudgetPosition2('P','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$pdf->report($id,$pro_id);
			
		$pdf->Output();

	}

}
