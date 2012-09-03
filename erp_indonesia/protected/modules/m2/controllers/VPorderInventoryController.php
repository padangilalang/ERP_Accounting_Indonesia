<?php

class VPorderInventoryController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
				'rights',
				'ajaxOnly + DeleteTempById',
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
					INSERT INTO v_porder_detail_temp (parent_id,item_id,description,qty,amount)
					VALUES ('1111', 1, 'tetere', 111, 2000000)
					";
					//VALUES ('".Yii::app()->session->sessionID."', ".$model->item_id.", '".$model->description."', ".$model->qty.", ".$model->amount.")
					Yii::app()->db->createCommand($sqlinsert)->execute();

				} else {

					$modelParent=new vPorder;
					$modelParent->input_date=$model->input_date;
					$modelParent->supplier_id=$model->supplier_id;
					$modelParent->remark=$model->remark;

					$modelParent->organization_id=sUser::model()->getGroup() ; //default user Group
					$modelParent->periode_date=Yii::app()->settings->get("System", "cCurrentPeriod");
					$modelParent->payment_state_id=1;
					$modelParent->journal_state_id=1;
					$modelParent->budgetcomp_id=0;
					$modelParent->po_type_id=1; //PO Inventory
					$modelParent->system_ref="temp";
					$modelParent->save();

					$modelParentExt=new vPorderExt;
					$modelParentExt->id=$modelParent->id;
					$modelParentExt->af_date=$modelParent->input_date;
					$modelParentExt->save();

					//cek if only one record, temporary table no need
					$sqlcount="select count(*) FROM v_porder_detail_temp";
					$_count=Yii::app()->db->createCommand($sqlcount)->queryScalar();

					if($_count ==0) {
						$sql="INSERT INTO v_porder_detail (parent_id, item_id, description, qty, amount)
						VALUES (".$modelParent->id.", ".$model->item_id.", '".$model->description."', ".$model->qty.", ".$model->amount.")";
					} else {
						$sql="INSERT INTO v_porder_detail (parent_id, item_id, description, qty, amount)
						SELECT ".$modelParent->id.", item_id, description, qty, amount FROM v_porder_detail_temp
						WHERE parent_id = '".Yii::app()->session->sessionID."'
						";
					}

					Yii::app()->db->createCommand($sql)->execute();

					//delete temporary table
					$sqlDelete="DELETE FROM v_porder_detail_temp WHERE parent_id = '".Yii::app()->session->sessionID."'";
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

		//$sql="SELECT * FROM v_porder_detail_temp WHERE parent_id = '".Yii::app()->session->sessionID."'";
		$sql="SELECT * FROM v_porder_detail_temp WHERE parent_id = '1111'";
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
			//$this->redirect(array('/m2/vPorderInventory',));
			$this->redirect(array('view',"id"=>$model->id));

		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['vPorder']))
		{
			$model->attributes=$_POST['vPorder'];

			if ($model->validate()) {
					
				if(Yii::app()->request->isAjaxRequest) {

					$sqlinsert="INSERT INTO v_porder_detail_temp (parent_id, item_id, description, qty, amount)
					VALUES (".$model->id.", ".$model->item_id.", '".$model->description."', ".$model->qty.", ".$model->amount.")";
					$command = Yii::app()->db->createCommand($sqlinsert);
					$command->execute();

				} else {

					$model->save();

					//Delete Old Detail Data
					$sqlDelete="DELETE FROM v_porder_detail WHERE parent_id = ':id'";
					$command = Yii::app()->db->createCommand($sqlDelete);
					$command->bindParam(":id", $id, PDO::PARAM_STR);
					$command->execute();

					//Insert New Data
					$sql="INSERT INTO v_porder_detail (parent_id, item_id, description, qty, amount)
					SELECT :id, item_id, description, qty, amount FROM v_porder_detail_temp
					WHERE parent_id = ':id'";
					$command = Yii::app()->db->createCommand($sql);
					$command->bindParam(":id", $id, PDO::PARAM_STR);
					$command->execute();

					//Delete Temporary Data
					$sqlD="DELETE FROM v_porder_detail_temp WHERE parent_id = ':id'";
					$command = Yii::app()->db->createCommand($sqlD);
					$command->bindParam(":id", $id, PDO::PARAM_STR);
					$command->execute();

					$this->redirect(array('/m2/vPorderInventory'));
				}
			}
		}


		if(!Yii::app()->request->isAjaxRequest) {
			$criteria=new CdbCriteria;
			$criteria->compare('parent_id',$model->id);
			$models=vPorderDetail::model()->findAll($criteria);

			$sqlcount="select count(*) FROM v_porder_detail_temp WHERE parent_id = '".$model->id."'";
			$command = Yii::app()->db->createCommand($sqlcount);
			$_count=$command->queryScalar();

			if($_count ==0) {
				foreach ($models as $mod) {
					$sql="INSERT INTO v_porder_detail_temp (parent_id, item_id, description, qty, amount)
					VALUES (".$mod->parent_id.", ".$mod->item_id.", '".$mod->description."', ".$mod->qty.", ".$mod->amount.")";
					$command = Yii::app()->db->createCommand($sql);
					$command->execute();

				}
			}
		}

		$sql="SELECT * FROM v_porder_detail_temp WHERE parent_id = '".$model->id."'";
		$command = Yii::app()->db->createCommand($sql);
		$rawData=$command->queryAll();

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
			$this->redirect(array('/m2/vPorderInventory'));
		}

		//if(Yii::app()->request->isPostRequest)
		//{
		$model->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(array('/m2/vPorderInventory'));
		//}
		//else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

	}

	public function actionDeleteTemp()
	{
		$sqlDelete="DELETE FROM v_porder_detail_temp WHERE parent_id = '".Yii::app()->session->sessionID."'";
		Yii::app()->db->createCommand($sqlDelete)->execute();

		$this->render('index',array("id"=>1));
		//$this->forward('index');

	}

	public function actionDeleteTempById($id)
	{
		$sqlDelete="DELETE FROM v_porder_detail_temp WHERE id = '".$id."'";
		Yii::app()->db->createCommand($sqlDelete)->execute();

		$sql="SELECT * FROM v_porder_detail_temp WHERE parent_id = '".$id."'";
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
		$model=vPorder::model()->findByPk($id,'po_type_id = 1');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vPorderInventory-form')
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

	public function actionWsdl()
	{
		$xml = simplexml_load_file("https://twitter.com/statuses/user_timeline.xml?id=peterjkambey");
		//$client = new SoapClient("https://twitter.com/statuses/user_timeline.xml?id=peterjkambey");
		echo $xml->children();
		die();

	}
	
	public function actionInvoice() 
	{
		// (c) Xavier Nicolay
		// Exemple de génération de devis/facture PDF

		//require('invoice.php');

		$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
		$pdf->AddPage();
		$pdf->addSociete( "MaSociete",
						  "MonAdresse\n" .
						  "75000 PARIS\n".
						  "R.C.S. PARIS B 000 000 007\n" .
						  "Capital : 18000 " . EURO );
		$pdf->fact_dev( "Devis ", "TEMPO" );
		$pdf->temporaire( "Devis temporaire" );
		$pdf->addDate( "03/12/2003");
		$pdf->addClient("CL01");
		$pdf->addPageNumber("1");
		$pdf->addClientAdresse("Ste\nM. XXXX\n3ème étage\n33, rue d'ailleurs\n75000 PARIS");
		$pdf->addReglement("Chèque à réception de facture");
		$pdf->addEcheance("03/12/2003");
		$pdf->addNumTVA("FR888777666");
		$pdf->addReference("Devis ... du ....");
		$cols=array( "REFERENCE"    => 23,
					 "DESIGNATION"  => 78,
					 "QUANTITE"     => 22,
					 "P.U. HT"      => 26,
					 "MONTANT H.T." => 30,
					 "TVA"          => 11 );
		$pdf->addCols( $cols);
		$cols=array( "REFERENCE"    => "L",
					 "DESIGNATION"  => "L",
					 "QUANTITE"     => "C",
					 "P.U. HT"      => "R",
					 "MONTANT H.T." => "R",
					 "TVA"          => "C" );
		$pdf->addLineFormat( $cols);
		$pdf->addLineFormat($cols);

		$y    = 109;
		$line = array( "REFERENCE"    => "REF1",
					   "DESIGNATION"  => "Carte Mère MSI 6378\n" .
										 "Processeur AMD 1Ghz\n" .
										 "128Mo SDRAM, 30 Go Disque, CD-ROM, Floppy, Carte vidéo",
					   "QUANTITE"     => "1",
					   "P.U. HT"      => "600.00",
					   "MONTANT H.T." => "600.00",
					   "TVA"          => "1" );
		$size = $pdf->addLine( $y, $line );
		$y   += $size + 2;

		$line = array( "REFERENCE"    => "REF2",
					   "DESIGNATION"  => "Câble RS232",
					   "QUANTITE"     => "1",
					   "P.U. HT"      => "10.00",
					   "MONTANT H.T." => "60.00",
					   "TVA"          => "1" );
		$size = $pdf->addLine( $y, $line );
		$y   += $size + 2;

		$pdf->addCadreTVAs();
				
		// invoice = array( "px_unit" => value,
		//                  "qte"     => qte,
		//                  "tva"     => code_tva );
		// tab_tva = array( "1"       => 19.6,
		//                  "2"       => 5.5, ... );
		// params  = array( "RemiseGlobale" => [0|1],
		//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
		//                      "remise"         => value,     // {montant de la remise}
		//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
		//                  "FraisPort"     => [0|1],
		//                      "portTTC"        => value,     // montant des frais de ports TTC
		//                                                     // par defaut la TVA = 19.6 %
		//                      "portHT"         => value,     // montant des frais de ports HT
		//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
		//                  "AccompteExige" => [0|1],
		//                      "accompte"         => value    // montant de l'acompte (TTC)
		//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
		//                  "Remarque" => "texte"              // texte
		$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
							array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
		$tab_tva = array( "1"       => 19.6,
						  "2"       => 5.5);
		$params  = array( "RemiseGlobale" => 1,
							  "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
							  "remise"         => 0,       // {montant de la remise}
							  "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
						  "FraisPort"     => 1,
							  "portTTC"        => 10,      // montant des frais de ports TTC
														   // par defaut la TVA = 19.6 %
							  "portHT"         => 0,       // montant des frais de ports HT
							  "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
						  "AccompteExige" => 1,
							  "accompte"         => 0,     // montant de l'acompte (TTC)
							  "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
						  "Remarque" => "Avec un acompte, svp..." );

		$pdf->addTVAs( $params, $tab_tva, $tot_prods);
		$pdf->addCadreEurosFrancs();
		$pdf->Output();
	
	}
	
	
}
