<?php

class BPorderInventoryController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'ajaxOnly + DeleteTempById',
		);
	}

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

	public function actionTest()
	{
		$this->render('test');
	}

	public function actionView($id)
	{
		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewDetail($id)
	{
		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$this->render('viewDetail',array(
				'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new fPorder;
		//$dataProvider = new CArrayDataProvider(array());
			
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['fPorder']))
		{
			$model->attributes=$_POST['fPorder'];

			if($model->validate()) {
				if(Yii::app()->request->isAjaxRequest) {

					$sqlinsert="
					INSERT INTO b_porder_detail_temp (parent_id,item_id,description,qty,amount)
					VALUES ('".Yii::app()->session->sessionID."', ".$model->item_id.", '".$model->description."', ".$model->qty.", ".$model->amount.")
					";
						
					Yii::app()->db->createCommand($sqlinsert)->execute();

				} else {

					$modelParent=new bPOrder;
					$modelParent->input_date=$model->input_date;
					$modelParent->supplier_id=$model->supplier_id;
					$modelParent->remark=$model->remark;

					$modelParent->organization_id=sUser::model()->getGroup() ; //default user Group
					$modelParent->periode_date=Yii::app()->settings->get("System", "cCurrentPeriod");
					$modelParent->payment_state_id=1;
					$modelParent->journal_state_id=1;
					$modelParent->budgetcomp_id=0;
					$modelParent->po_type_id=1; //PO Inventory
					$modelParent->save();
						
					//cek if only one record, temporary table no need
					$sqlcount="select count(*) FROM b_porder_detail_temp";
					$_count=Yii::app()->db->createCommand($sqlcount)->queryScalar();
						
					if($_count ==0) {
						$sql="INSERT INTO b_porder_detail (parent_id, item_id, description, qty, amount)
						VALUES (".$modelParent->id.", ".$model->item_id.", '".$model->description."', ".$model->qty.", ".$model->amount.")";
					} else {
						$sql="INSERT INTO b_porder_detail (parent_id, item_id, description, qty, amount)
						SELECT ".$modelParent->id.", item_id, description, qty, amount FROM b_porder_detail_temp
						WHERE parent_id = '".Yii::app()->session->sessionID."'
						";
					}
						
					Yii::app()->db->createCommand($sql)->execute();
						
					//delete temporary table
					$sqlDelete="DELETE FROM b_porder_detail_temp WHERE parent_id = '".Yii::app()->session->sessionID."'";
					Yii::app()->db->createCommand($sqlDelete)->execute();
						
					//Create System_ref
					$_ref ="PO-".$modelParent->periode_date."-".str_pad($modelParent->id,5,"0",STR_PAD_LEFT);
					$modelParent->system_ref=$_ref;
					$modelParent->save();

					Yii::app()->user->setFlash("success","<strong>Great!</strong> PO created succesfully...");
					$this->redirect(array('view',"id"=>$modelParent->id));
				}
			}
		}

		$sql="SELECT * FROM b_porder_detail_temp WHERE parent_id = '".Yii::app()->session->sessionID."'";
		$rawData=Yii::app()->db->createCommand($sql)->queryAll();

		$dataProvider=new CArrayDataProvider($rawData, array(
				'pagination'=>false
		));

		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('_formDetail',array(
					'model'=>$model,
					'dataProvider'=>$dataProvider,
			));
		} else {
			$this->render('create',array(
					'model'=>$model,
					'dataProvider'=>$dataProvider,
			));
		}
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if ($model->approved_date !=null) {
			Yii::app()->user->setFlash("error","<strong>Error!</strong> PO already approved. Can't be edited...");
			//$this->redirect(array('/m2/bPorderInventory',));
			$this->redirect(array('view',"id"=>$model->id));

		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['bPorder']))
		{
			$model->attributes=$_POST['bPorder'];

			if ($model->validate()) {
					
				if(Yii::app()->request->isAjaxRequest) {

					$sqlinsert="
					INSERT INTO b_porder_detail_temp (parent_id,item_id,description,qty,amount)
					VALUES ('".$model->id."', ".$model->item_id.", '".$model->description."', ".$model->qty.", ".$model->amount.")
					";
						
					Yii::app()->db->createCommand($sqlinsert)->execute();

				} else {

					$model->save();
						
					//Delete Old Detail Data
					$sqlDelete="DELETE FROM b_porder_detail WHERE parent_id = '".$model->id."'";
					Yii::app()->db->createCommand($sqlDelete)->execute();

					//Insert New Data
					$sql="INSERT INTO b_porder_detail (parent_id, item_id, description, qty, amount)
					SELECT ".$model->id.", item_id, description, qty, amount FROM b_porder_detail_temp
					WHERE parent_id = '".$model->id."'
					";
					Yii::app()->db->createCommand($sql)->execute();

					//Delete Temporary Data
					$sqlDelete="DELETE FROM b_porder_detail_temp WHERE parent_id = '".$model->id."'";
					Yii::app()->db->createCommand($sqlDelete)->execute();
						
					$this->redirect(array('/m2/bPorderInventory'));
				}
			}
		}


		if(!Yii::app()->request->isAjaxRequest) {
			$criteria=new CdbCriteria;
			$criteria->compare('parent_id',$model->id);
			$models=bPorderDetail::model()->findAll($criteria);

			$sqlcount="select count(*) FROM b_porder_detail_temp WHERE parent_id = '".$model->id."'";
			$_count=Yii::app()->db->createCommand($sqlcount)->queryScalar();
				
			if($_count ==0) {
				foreach ($models as $mod) {
					$sql="INSERT INTO b_porder_detail_temp (parent_id, item_id, description, qty, amount)
					VALUES (".$mod->parent_id.", ".$mod->item_id.", '".$mod->description."', ".$mod->qty.", ".$mod->amount.")";
						
					Yii::app()->db->createCommand($sql)->execute();
				}
			}
		}

		$sql="SELECT * FROM b_porder_detail_temp WHERE parent_id = '".$model->id."'";
		$rawData=Yii::app()->db->createCommand($sql)->queryAll();

		$dataProvider=new CArrayDataProvider($rawData, array(
				'pagination'=>false
		));

		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('_formDetail',array(
					'model'=>$model,
					'dataProvider'=>$dataProvider,
			));
		} else {
			$this->render('update',array(
					'model'=>$model,
					'dataProvider'=>$dataProvider,
			));
		}
	}

	public function actionDelete($id)
	{

		$model=$this->loadModel($id);

		if ($model->approved_date !=null) {
			Yii::app()->user->setFlash("error","<strong>Error!</strong> PO already approved. Can't be deleted...");
			$this->redirect(array('/m2/bPorderInventory'));
		}

		//if(Yii::app()->request->isPostRequest)
		//{
		$model->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(array('/m2/bPorderInventory'));
		//}
		//else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

	}

	public function actionDeleteTemp()
	{
		$sqlDelete="DELETE FROM b_porder_detail_temp WHERE parent_id = '".Yii::app()->session->sessionID."'";
		Yii::app()->db->createCommand($sqlDelete)->execute();

		$this->render('index',array("id"=>1));
		//$this->forward('index');

	}

	public function actionDeleteTempById($id)
	{
		$sqlDelete="DELETE FROM b_porder_detail_temp WHERE id = '".$id."'";
		Yii::app()->db->createCommand($sqlDelete)->execute();

		$sql="SELECT * FROM b_porder_detail_temp WHERE parent_id = '".$id."'";
		$rawData=Yii::app()->db->createCommand($sql)->queryAll();

		$dataProvider=new CArrayDataProvider($rawData, array(
				'pagination'=>false
		));
		$this->renderPartial('_formDetail',array(
				'dataProvider'=>$dataProvider,
		));

	}

	public function actionIndex($id=1)
	{
		$this->render('index',array(
				'id'=>$id,
		));
	}


	public function loadModel($id)
	{
		$model=bPorder::model()->findByPk($id,'po_type_id = 1');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bPorderInventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/////////////////////////////////////////////////////
	public function actionReport1($id)
	{
		$pdf=new pRequest1('L','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$pdf->pRequestR1($id);

		$pdf->Output();

	}

	public function actionDynamicItems()
	{
		$data=pProduct::model()->findAll();

		$data=CHtml::listData($data,'id','no_polisi');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value'=>$value),CHtml::encode($name),true);
		}

	}

	public function actionGrid()
	{
		if(isset($_POST['gifts']))
		{
			$_cArray=CJSON::decode($_POST['gifts']);
			$model->attributes=$_cArray[0];

			echo print_r($_POST['bPorder']);
			die;
		}

		$this->render('grid',array(
		));
	}

	public function actionWsdl()
	{
		$xml = simplexml_load_file("https://twitter.com/statuses/user_timeline.xml?id=peterjkambey");
		//$client = new SoapClient("https://twitter.com/statuses/user_timeline.xml?id=peterjkambey");
		echo $xml->children();
		die();

	}
}
