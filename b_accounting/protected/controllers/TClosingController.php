<?php

class TClosingController extends Controller
{
	public $layout='//layouts/column1';

	public function filters()
	{
		return array(
				'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
				array('allow',
						//'users'=>array('@'),
						'users'=>sUser::getAccess('87'),
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}

	public function transferNewPeriod()
	{
		$_curPeriod = Yii::app()->settings->get("System", "cCurrentPeriod");
		$_nextPeriod = sParameter::cBeginDateAfter(Yii::app()->settings->get("System", "cCurrentPeriod"));

		$models=tBalanceSheet::model()->findAll('yearmonth_periode = '.$_curPeriod);

		foreach ($models as $model){
			if ($model->account->getTypeValue() == 1) {
				$sql='INSERT INTO t_balance_sheet (parent_id, yearmonth_periode, type_balance_id, remark, budget, beginning_balance,debit,credit,end_balance) VALUES ('
				.$model->parent_id.','
				.$_nextPeriod.', 1, "Automated posted", 0,'
				.$model->end_balance.',0,0,'
				.$model->end_balance.')';
			} else {
				$sql='INSERT INTO t_balance_sheet (parent_id, yearmonth_periode, type_balance_id, remark, budget, beginning_balance,debit,credit,end_balance) VALUES ('
				.$model->parent_id.','
				.$_nextPeriod.', 1, "Automated posted", 0,0,0,0,0)';
			}

			$command=Yii::app()->db->createCommand($sql);

			$command->execute();

			tBalanceSheet::model()->updateAll(array('type_balance_id'=>2),'yearmonth_periode = '.$_curPeriod);
		}
	}

	public function actionClosingPeriod()
	{
		$this->render('/tPosting/closingPeriod',array(
		));

	}

	public function actionClosingPeriodExecution()
	{
		uJournal::model()->updateAll(array('state_id'=>3,'updated_date'=>time(),'updated_id'=>Yii::app()->user->id),
				'state_id !=4 AND yearmonth_periode = '.Yii::app()->settings->get("System", "cCurrentPeriod"));

		$this->transferNewPeriod();

		$_nextPeriod = sParameter::cBeginDateAfter(Yii::app()->settings->get("System", "cCurrentPeriod"));
		Yii::app()->settings->set("System", "cCurrentPeriod", $_nextPeriod, $toDatabase=true);

	}
}
