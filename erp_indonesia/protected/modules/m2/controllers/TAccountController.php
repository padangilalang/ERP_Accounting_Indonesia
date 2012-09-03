<?php

class TAccountController extends Controller
{
	public $layout='//layouts/column3account';

	public function filters()
	{
		return array(
				'rights',
		);
	}

	public function newEntity($id)
	{
		$model=new tAccountEntity;

		//$this->performAjaxValidation($model);

		if(isset($_POST['tAccountEntity']))
		{
			$model->attributes=$_POST['tAccountEntity'];
			$model->parent_id = $id;
			if($model->save()) {
				$this->redirect(array('view','id'=>$id,'#'=>'yw4_tab_2'));
			} else
				Yii::app()->user->setFlash("error","<strong>Error!</strong> This Entity already inputed...");
		}

		return $model;
	}

	public function actionViewJournal($id)
	{
		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

		$model=uJournal::model()->findByPk($id);

		$this->render('/uJournal/view',array(
				'model'=>$model,
		));
	}

	public function actionView($id)
	{
		$this->layout = '//layouts/column2breadcrumb';

		$account=$this->newAccount($id);
		$entity=$this->newEntity($id);
		/*
		 $criteria=new CDbCriteria;

		$criteria->compare('account_no_id',$id);
		$criteria->with=('journal');
		$criteria->compare('yearmonth_periode',Yii::app()->settings->get("System", "cCurrentPeriod"));

		$total=uJournalDetail::model()->count($criteria);

		$pages = new CPagination($total);
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
		*/

		$this->render('view',array(
				'model'=>$this->loadModel($id),
				'modelAccount'=>$account,
				'modelEntity'=>$entity,
				//'pages'=>$pages,
		));
	}

	public function newAccount($id)
	{
		$model=new tAccount('newaccount');

		// $this->performAjaxValidation($model);

		if(isset($_POST['tAccount']))
		{
			$model->attributes=$_POST['tAccount'];
			$model->parent_id=$id;

			if($model->save()) {

				//haschild
				$modelProperties2Add = new tAccountProperties();
				$modelProperties2Add->parent_id=$model->id;
				$modelProperties2Add->mkey="haschild_id";
				$modelProperties2Add->mvalue=$_POST['tAccount']['haschild_id'];
				$modelProperties2Add->save();

				//currency
				//$modelProperties3Add = new tAccountProperties();
				//$modelProperties3Add->parent_id=$model->id;
				//$modelProperties3Add->mkey="currency_id";
				//$modelProperties3Add->mvalue=$_POST['tAccount']['currency_id'];
				//$modelProperties3Add->save();

				//state
				//$modelProperties4Add = new tAccountProperties();
				//$modelProperties4Add->parent_id=$model->id;
				//$modelProperties4Add->mkey="state_id";
				//$modelProperties4Add->mvalue=$_POST['tAccount']['state_id'];
				//$modelProperties4Add->save();

				//Balance
				$modelProperties5Add = new tBalanceSheet();
				$modelProperties5Add->parent_id=$model->id;
				$modelProperties5Add->yearmonth_periode=Yii::app()->settings->get("System", "cCurrentPeriod");
				$modelProperties5Add->type_balance_id=1;
				$modelProperties5Add->debit=0;
				$modelProperties5Add->credit=0;
				$modelProperties5Add->beginning_balance=$_POST['tAccount']['beginning_balance'];
				$modelProperties5Add->end_balance=$_POST['tAccount']['beginning_balance'];
				$modelProperties5Add->save();

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		return $model;
	}

	public function actionCreate()   //create Root
	{
		$model=new tAccount;

		// $this->performAjaxValidation($model);

		if(isset($_POST['tAccount']))
		{
			$model->attributes=$_POST['tAccount'];
			$model->parent_id=0;
			$model->haschild_id=2; //must have children

			if($model->save()) {
				//accmain
				$modelProperties0Add = new tAccountProperties();
				$modelProperties0Add->parent_id=$model->id;
				$modelProperties0Add->mkey="accmain_id";
				$modelProperties0Add->mvalue=$_POST['tAccount']['accmain_id']; //must have children
				$modelProperties0Add->save();

				//haschild
				$modelProperties1Add = new tAccountProperties();
				$modelProperties1Add->parent_id=$model->id;
				$modelProperties1Add->mkey="haschild_id";
				$modelProperties1Add->mvalue=2; //must have children
				$modelProperties1Add->save();

				//currency
				$modelProperties2Add = new tAccountProperties();
				$modelProperties2Add->parent_id=$model->id;
				$modelProperties2Add->mkey="currency_id";
				$modelProperties2Add->mvalue=$_POST['tAccount']['currency_id'];
				$modelProperties2Add->save();

				//state
				$modelProperties3Add = new tAccountProperties();
				$modelProperties3Add->parent_id=$model->id;
				$modelProperties3Add->mkey="state_id";
				$modelProperties3Add->mvalue=$_POST['tAccount']['state_id'];
				$modelProperties3Add->save();

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('createroot',array(
				'model'=>$model,
		));
	}

	public function actionUpdateRoot($id)
	{
		$model=$this->loadModelRoot($id);

		// $this->performAjaxValidation($model);

		if(isset($_POST['tAccount']))
		{
			$model->attributes=$_POST['tAccount'];
			$model->haschild_id=2; //to prevent error validation
			if($model->save()) {
				//accmain_id
				$modelProperties0=tAccountProperties::model()->find(array(
						'condition'=>'mkey = \'accmain_id\' AND parent_id = :id',
						'params'=>array(':id'=>$id),
				));
				$modelProperties0->mvalue=$_POST['tAccount']['accmain_id'];
				$modelProperties0->save();

				//currency_id
				$modelProperties2=tAccountProperties::model()->find(array(
						'condition'=>'mkey = \'currency_id\' AND parent_id = :id',
						'params'=>array(':id'=>$id),
				));
				$modelProperties2->mvalue=$_POST['tAccount']['currency_id'];
				$modelProperties2->save();

				//state_id
				$modelProperties3=tAccountProperties::model()->find(array(
						'condition'=>'mkey = \'state_id\' AND parent_id = :id',
						'params'=>array(':id'=>$id),
				));
				$modelProperties3->mvalue=$_POST['tAccount']['state_id'];
				$modelProperties3->save();

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$model->accmain_id=$model->accmain->mvalue;
		$model->currency_id=$model->currency->mvalue;
		$model->state_id=$model->state->mvalue;

		$this->render('updateroot',array(
				'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if ($model->parent_id == 0) $this->forward('updateRoot');

		// $this->performAjaxValidation($model);

		if(isset($_POST['tAccount']))
		{
			$model->attributes=$_POST['tAccount'];
			if($model->save()) {
					
				$model->account_properties=$_POST['account_properties'];
				$model->value=$_POST['value'];
				$model->text=$_POST['text'];
					
				tAccountProperties::model()->deleteAll('parent_id = '.$id); //delete All Related Properties

				for($i = 0; $i < sizeof($model->account_properties); ++$i):
				$modelProp=new tAccountProperties;
				$modelProp->parent_id=$id;
				$modelProp->mkey=$model->account_properties[$i];
				$modelProp->mvalue=$model->value[$i];
				$modelProp->mtext=$model->text[$i];

				$modelProp->save();
				endfor;

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		if (isset($model->haschild))  $model->haschild_id = $model->haschild->mvalue;
		if (isset($model->currency))  $model->currency_id = $model->currency->mvalue;
		if (isset($model->state))  $model->state_id = $model->state->mvalue;

		if(!isset($_POST['account_properties'])) {
			$modelDetail = tAccountProperties::model()->findAll('parent_id ='.$model->id);

			foreach ($modelDetail as $mm) {
				$model->account_properties[]=$mm->mkey;

				$model->value[]=$mm->mvalue;

				$model->text[]=$mm->mtext;

			}
		}


		$this->render('update',array(
				'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$cekJournal=$this->loadModel($id)->hasJournal;

		if (!empty($cekJournal)) {
			Yii::app()->user->setFlash("error","<strong>Error!</strong> Account cannot be deleted. It is must empty transaction on current period...");
			$this->redirect(array('/m2/tAccount/view','id'=>$id));
		} else {
			$this->loadModel($id)->delete();
			$this->redirect(array('/m2/tAccount'));
		}
	}

	public function actionDeleteEntity($id)
	{
		$this->loadModelEntity($id)->delete();
	}

	public function actionIndex()
	{
		$model=new tAccount('search');
		$model->unsetAttributes();

		$criteria=new CDbCriteria;

		if(isset($_GET['tAccount'])) {
			$model->attributes=$_GET['tAccount'];

			$criteria->compare('account_name',$_GET['tAccount']['account_name'],true);
		}

		$criteria->order='account_no';

		$total = tAccount::model()->count();

		$pages = new CPagination($total);
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
			
			
		$dataProvider=tAccount::model()->findAll($criteria);

		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
				'pages' => $pages,
		));
	}

	public function loadModel($id)
	{
		$model=tAccount::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelRoot($id)
	{
		$model=tAccount::model()->findByPk($id,array('condition'=>'parent_id = 0'));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelEntity($id)
	{
		$model=tAccountEntity::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='t-account-form')
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
		//mySQL
		/**/
		$req = Yii::app()->db->createCommand(
				"SELECT m1.id, m1.account_name AS text, m2.id IS NOT NULL AS hasChildren
				FROM t_account AS m1 LEFT JOIN t_account AS m2 ON m1.id=m2.parent_id
				WHERE m1.parent_id = $parentId
				GROUP BY m1.id ORDER BY m1.account_no ASC"
		);
		/**/

		//Postgree
		/*$req = Yii::app()->db->createCommand(
		 "SELECT m1.id, m1.account_name AS text, m2.id IS NOT NULL AS hasChildren
				FROM t_account AS m1 LEFT JOIN t_account AS m2 ON m1.id=m2.parent_id
				WHERE m1.parent_id = $parentId"
		);
		*/
		$children = $req->queryAll();

		$treedata=array();
		foreach($children as $child){
			$options=array('href'=>Yii::app()->createUrl('/m2/tAccount/view',array('id'=>$child['id'])),'id'=>$child['id'],'class'=>'treenode');
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

	public function actionAccountAutoComplete()
	{
		$res =array();
		if (isset($_GET['term'])) {
			$qtxt ="SELECT account_name as name FROM t_account WHERE account_name LIKE :name ORDER BY account_name LIMIT 20";
			//$qtxt ="SELECT account_name as label, id FROM t_account WHERE account_name LIKE :name ORDER BY account_name LIMIT 20";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":name", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			$res =$command->queryColumn();
			//$res =$command->queryAll();

		}
		echo CJSON::encode($res);
	}

	public function actionPrintList()
	{
		$model=new fJournalList;

		if(isset($_POST['fJournalList']))
		{
			$model->attributes=$_POST['fJournalList'];
			if($model->validate()) {

				if ($_POST['fJournalList']['type_report_id'] == 1) {
					$pdf=new journalVoucherList2('P','mm','A4');
				} else
					$pdf=new journalVoucherList1('P','mm','A4');

				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->SetFont('Arial','',12);

				$pdf->report($model->account_no_id,$model->begindate,$model->enddate,$model->post_id);
				$pdf->Output();

			}
		}

		$this->render('printList',array('model'=>$model));
	}


	private $_indexFiles = 'runtime.search';

	public function actionSearchIndex()
	{
		$this->layout='column2';
		if (($term = Yii::app()->getRequest()->getParam('q', null)) !== null) {
			$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));
			$results = $index->find($term);
			$query = Zend_Search_Lucene_Search_QueryParser::parse($term);

			$this->render('/sParameter/search', compact('results', 'term', 'query'));
		}
	}
	/**
	 * Search index creation
	 */
	public function actionSearchCreate()
	{
		$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);

		$posts = tAccount::model()->findAll();
		foreach($posts as $post){
			$doc = new Zend_Search_Lucene_Document();

			$doc->addField(Zend_Search_Lucene_Field::Text('account_no',
					CHtml::encode($post->account_no), 'utf-8')
			);

			$doc->addField(Zend_Search_Lucene_Field::Text('short_description',
					CHtml::encode($post->short_description)
					, 'utf-8')
			);

			$doc->addField(Zend_Search_Lucene_Field::Text('account_name',
					CHtml::encode($post->account_name)
					, 'utf-8')
			);


			$index->addDocument($doc);
		}
		$index->commit();
		echo 'Lucene index created';
	}


}
