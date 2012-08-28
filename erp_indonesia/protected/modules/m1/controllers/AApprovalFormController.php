<?php

class AApprovalFormController extends Controller
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
				'accessControl', // perform access control for CRUD operations
				'ajaxOnly + UpdatePaid, UpdateDetailPaid,UpdateApproved'
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
		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

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

		if(isset($_POST['aApprovalForm']))
		{
			$model->attributes=$_POST['aApprovalForm'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex($id=1,$cid=null)
	{
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('_gridAF',array(
					'id'=>$id,
					'cid'=>$cid,
			));
		} else {
			$this->render('index',array(
					'id'=>$id,
					'cid'=>$cid,
			));
		}
	}

	/////////////////////////////////////////////////////
	public function actionReport1($id)
	{
		$pdf=new aApprovalForm1('P','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$pdf->approvalFormR1($id);
			
		$pdf->Output();

	}

	public function actionReport2($id)
	{
		$pdf=new aApprovalForm2('P','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$pdf->approvalFormR2($id);
			
		$pdf->Output();

	}

	public function loadModel($id)
	{
		$model=aPorder::model()->with('po_detail_group')->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='AApprovalForm-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpdatePaid($id)
	{
		aPorder::model()->updateByPk((int)$id,array('payment_state_id'=>3,'payment_date'=>new CDbExpression('NOW()')));
		aPorderDetail::model()->updateAll(array('detail_payment_id'=>3),array(
				'condition'=>'parent_id = :id',
				'params'=>array(':id'=>$id),
		));
	}

	public function actionUpdateDetailPaid($id)
	{
		aPorderDetail::model()->updateByPk((int)$id,array('detail_payment_id'=>3));
	}

	public function actionUpdateApproved($id)
	{
		$model=$this->loadModel($id);
		if($model->approved_date ==null) {

			#----------------------------------------
			#Budget Detail
			$modelbd=aBudgetDetail::model()->find(array(
					'condition'=>'parent_id = :parent',
					'params'=>array(':parent'=>$model->budgetcomp_id),
			));
			
		if($modelbd==null) { //Step 1. null berarti saldo baru berjalan, jadi cek saldo awal


			$modelbd1=new aBudgetDetail;
			$modelbd1->parent_id=$model->budgetcomp_id;
			$modelbd1->input_date = new CDbExpression("now()");
			$modelbd1->periode_date=0;
			$modelbd1->no_ref='temp';
			$modelbd1->prequest_id =0;
			$modelbd1->tdebt=$model->budgetcomp->amount;
			$modelbd1->balance=$model->budgetcomp->amount;
			$modelbd1->created_by='admin';
			$modelbd1->created_date=time();
			$modelbd1->save();
		}
			
		//Step 2. Get Saldo
		$bd_balance=aBudgetDetail::model()->getSaldo($model->budgetcomp_id);
			
		$command=Yii::app()->db->createCommand(
				'INSERT INTO a_budget_detail (parent_id, input_date, periode_date, no_ref, prequest_id, tdebt, tcredit, balance, remark, created_date, created_by)
				SELECT a.budgetcomp_id, a.input_date, a.periode_date, a.no_ref, a.id, 0, Sum(b.qty*b.amount),
				:balance - Sum(b.qty*b.amount), \'Automatic Posting\', '.time().',\''.Yii::app()->user->name .'\'
				FROM a_porder a
				INNER JOIN a_porder_detail b ON a.id = b.parent_id
				WHERE a.id = :id
				GROUP BY a.budgetcomp_id, a.input_date, a.no_ref, a.id');

		$command->bindParam(":id", $id, PDO::PARAM_STR);
		$command->bindParam(":balance", $bd_balance, PDO::PARAM_STR);
		$command->execute();
			
		#------------------------------------
		#Budget Department
/*		foreach ($model->po_detail_group as $mod) {

			$criteria=new CDbCriteria;
			$criteria->compare('parent_id',$mod->budget_id);
			$criteria->compare('department_id',$mod->department_id);

			$cekDeptBudget=aBudget::model()->find($criteria); //Cek Budget Besar Apakah ada budget dept dari component ini

			if ($cekDeptBudget != null) { //Jika tidak ada ignore
				$modelbd=aBudgetDepartment::model()->find($criteria);
					
				if($modelbd==null) { //Step 1. Cek Existing Data. Jika belom pernah diisi, maka diisi

					$modelbd1=new aBudgetDepartment;
					$modelbd1->parent_id=$mod->budget_id;
					$modelbd1->input_date = new CDbExpression("now()");
					$modelbd1->periode_date=0;
					$modelbd1->no_ref='temp';
					$modelbd1->department_id =$mod->department_id;
					$modelbd1->tdebt=$cekDeptBudget->amount; //karena budget-nya ada, amountnya diambil
					$modelbd1->tcredit=0; 
					$modelbd1->balance=$cekDeptBudget->amount; //karena budget-nya ada, amountnya diambil
					$modelbd1->created_by='admin';
					$modelbd1->created_date=time();
					$modelbd1->save();

				}

				//Step 2. Get Saldo, baik diproses dari saldo diatas maupun existing Saldo
				$bd_balanceDept = aBudgetDepartment::model()->getSaldo($mod->budget_id,$mod->department_id);
			} else {
				//Step 2. Get Saldo, baik diproses dari saldo diatas maupun existing Saldo
				$bd_balanceDept = $mod->sub_total;
			}

			$command=Yii::app()->db->createCommand();
			$command->insert('a_budget_department',array(
					'parent_id'=>$mod->budget_id,
					'input_date'=>$model->input_date,
					'periode_date'=>$model->periode_date,
					'no_ref'=>$model->no_ref,
					'department_id'=>$mod->department_id,
					'tdebt'=>0,
					'tcredit'=>$mod->sub_total,
					'balance'=>$bd_balanceDept-$mod->sub_total,
					'remark'=>"Automatic Posting",
					'created_date'=>time(),
					'created_by'=>Yii::app()->user->id,
			));
		}
*/
		$_date= Yii::app()->dateFormatter->format("yyyy-MM-dd",time());
		aPorder::model()->updateByPk((int)$model->id,array('approved_date'=>$_date));
		}

	}



}
