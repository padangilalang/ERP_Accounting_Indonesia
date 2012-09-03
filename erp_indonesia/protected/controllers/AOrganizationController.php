<?php

class AOrganizationController extends Controller
{
	public $layout='//layouts/column3structure';

	public function filters()
	{
		return array(
				'rights',
		);
	}

	public function actionView($id)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new aOrganization;

		// $this->performAjaxValidation($model);

		if(isset($_POST['aOrganization']))
		{
			$model->attributes=$_POST['aOrganization'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// $this->performAjaxValidation($model);

		if(isset($_POST['aOrganization']))
		{
			$model->attributes=$_POST['aOrganization'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$model=new aOrganization('search');
		$model->unsetAttributes();

		$criteria=new CDbCriteria;

		if(isset($_GET['aOrganization'])) {
			$model->attributes=$_GET['aOrganization'];

			$criteria->compare('nama_gbi',$_GET['aOrganization']['name'],true);
		}

		$dataProvider=new CActiveDataProvider('aOrganization', array(
				'criteria'=>$criteria,
		));


		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
		));
	}


	public function loadModel($id)
	{
		$model=aOrganization::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='c-jemaat-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAjaxFillTree()
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
				. "FROM a_organization AS m1 LEFT JOIN a_organization AS m2 ON m1.id=m2.parent_id "
				. "WHERE m1.parent_id <=> $parentId "
				. "GROUP BY m1.id ORDER BY m1.id ASC"
		);
		$children = $req->queryAll();

		$treedata=array();
		foreach($children as $child){
			$options=array('href'=>Yii::app()->createUrl('aOrganization/view',array('id'=>$child['id'])),'id'=>$child['id'],'class'=>'treenode');
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

	public function actionKabupatenUpdate() {
		$cat_id = $_POST['aOrganization']['propinsi_id'];
		$data=sKabupatenPropinsi::model()->findAll(array(
				'condition'=>'parent_id = :cat_id',
				'params'=>array(':cat_id'=>$cat_id),
				'order'=>'sort'
		));

		$data=CHtml::listData($data,'id','nama');
		foreach($data as $value=>$kabupaten_id)  {
			echo CHtml::tag('option',
					array('value'=>$value),CHtml::encode($kabupaten_id),true);
		}
	}



}
