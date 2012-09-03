<?php

class aPorderController extends Controller
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
		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';
		//----- end new code --------------------

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
		$model=new aPorder;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['aPorder']))
		{
			$model->attributes=$_POST['aPorder'];

			if($model->validate()) {
					
				$modelHeader=new aPorder;
				$modelHeader->input_date=$model->input_date;
				$modelHeader->no_ref=$model->no_ref;
				$modelHeader->periode_date=$model->periode_date;
				$modelHeader->budgetcomp_id=$model->budgetcomp_id;
				$modelHeader->remark=$model->remark;
				$modelHeader->issuer_id=$model->issuer_id;
				$modelHeader->organization_id=sUser::model()->getGroup() ; //default user Group
				$modelHeader->payment_state_id=1;
				$modelHeader->save();

				//Detail...
				$model->budget_id=$_POST['budget_id'];
				$model->description=$_POST['description'];
				$model->user=$_POST['user'];
				//$model->qty=$_POST['qty'];
				$model->amount=$_POST['amount'];
					
				for($i = 0; $i < sizeof($model->budget_id); ++$i):
					$modelDetail=new aPorderDetail;
					$modelDetail->parent_id=$modelHeader->id;
					$modelDetail->budget_id=$model->budget_id[$i];
					$modelDetail->description=$model->description[$i];
					$modelDetail->user=$model->user[$i];
					($model->qty[$i] != null) ? $modelDetail->qty=$model->qty[$i] : $modelDetail->qty=1;
					($model->amount[$i] != null) ? $modelDetail->amount=$model->amount[$i] : $modelDetail->amount=0;
					$modelDetail->detail_payment_id=1;
					$modelDetail->department_id=0;

					$modelDetail->save();
				endfor;
					
				$this->redirect(array('/m1/aPorder'));
			}
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}

	public function actionCreateDept()
	{
		$model=new aPorder;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['aPorder']))
		{
			$model->attributes=$_POST['aPorder'];

			if($model->validate()) {
					
				$modelHeader=new aPorder;
				$modelHeader->input_date=$model->input_date;
				$modelHeader->no_ref=$model->no_ref;
				$modelHeader->periode_date=$model->periode_date;
				$modelHeader->budgetcomp_id=$model->budgetcomp_id;
				$modelHeader->remark=$model->remark;
				$modelHeader->issuer_id=$model->issuer_id;
				$modelHeader->organization_id=sUser::model()->getGroup() ; //default user Group
				$modelHeader->payment_state_id=1;
				$modelHeader->save();

				//Detail...
				$model->budget_id=$_POST['budget_id'];
				$model->department_id=$_POST['department_id'];
				$model->description=$_POST['description'];
				//$model->user=$_POST['user'];
				//$model->qty=$_POST['qty'];
				$model->amount=$_POST['amount'];
					
				for($i = 0; $i < sizeof($model->budget_id); ++$i):
					$modelDetail=new aPorderDetail;
					$modelDetail->parent_id=$modelHeader->id;
					$modelDetail->budget_id=$model->budget_id[$i];
					$modelDetail->department_id=$model->department_id[$i];
					$modelDetail->description=$model->description[$i];
					$modelDetail->user=$model->user[$i];
					($model->qty[$i] != null) ? $modelDetail->qty=$model->qty[$i] : $modelDetail->qty=1;
					($model->amount[$i] != null) ? $modelDetail->amount=$model->amount[$i] : $modelDetail->amount=0;

					$modelDetail->save();
				endfor;
					
					
				$this->redirect(array('/m1/aPorder'));

			}
		}

		$this->render('createDept',array(
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

		if(isset($_POST['aPorder']))
		{
			$model->attributes=$_POST['aPorder'];

			if($model->validate()) {
					
				$modelHeader=$this->loadModel($id);
				$modelHeader->input_date=$model->input_date;
				$modelHeader->no_ref=$model->no_ref;
				$modelHeader->periode_date=$model->periode_date;
				$modelHeader->budgetcomp_id=$model->budgetcomp_id;
				$modelHeader->remark=$model->remark;
				$modelHeader->issuer_id=$model->issuer_id;
				$modelHeader->organization_id=sUser::model()->getGroup() ; //default user Group
				$modelHeader->payment_state_id=1;
				$modelHeader->save();

				//Detail...
				$model->budget_id=$_POST['budget_id'];
				$model->department_id=$_POST['department_id'];
				$model->description=$_POST['description'];
				//$model->user=$_POST['user'];
				//$model->qty=$_POST['qty'];
				$model->amount=$_POST['amount'];
					
				$t=aPorderDetail::model()->deleteAll(array(
						'condition'=>'parent_id = :id',
						'params'=>array(':id'=>(int)$id),
				));

				for($i = 0; $i < sizeof($model->budget_id); ++$i):
				$modelDetail=new aPorderDetail;
				$modelDetail->parent_id=$modelHeader->id;
				$modelDetail->budget_id=$model->budget_id[$i];
				$modelDetail->department_id=$model->department_id[$i];
				$modelDetail->description=$model->description[$i];
				//$modelDetail->user=$model->user[$i];
				//($model->qty[$i] != null) ? $modelDetail->qty=$model->qty[$i] : $modelDetail->qty=1;
				$modelDetail->qty=1;
				($model->amount[$i] != null) ? $modelDetail->amount=$model->amount[$i] : $modelDetail->amount=0;

				$modelDetail->detail_payment_id=1;
				$modelDetail->save();
				endfor;
					
					
				$this->redirect(array('/m1/aPorder'));

			}
		}

		$modelDetail = aPorderDetail::model()->findAll(array(
				'condition'=>'parent_id = :parent',
				'params'=>array(':parent'=>$model->id),
				'order'=>'id'
		));

		foreach ($modelDetail as $mm) {

			$model->department_id[]=$mm->department_id;

			$model->budget_id[]=$mm->budget_id;

			$model->description[]=$mm->description;

			$model->amount[]=$mm->amount;
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
		$this->loadModel($id)->delete();
		//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionDeleteDetail($id)
	{
		$model=aPorderDetail::model()->with('po')->findByPk($id);
		if ($model->po->approved_date == null)
			$model->delete();

		$this->redirect(array('/aPorder/view','id'=>$model->parent_id));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id=1)
	{
		$this->render('index',array(
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
		$model=aPorder::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='aPorder-form')
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

}
