<?php

class TPostingController extends Controller
{
	public $layout='//layouts/column1';

	public function filters()
	{
		return array(
				'rights',
		);
	}

	public function labarugiExecution()
	{
		$_curPeriod = Yii::app()->settings->get("System", "cCurrentPeriod");

		$_labarugi=tAccount::netprofit($_curPeriod);

		$_lraccount=tAccount::model()->with('accmain')->find('accmain.mvalue=8')->id;

		$modelBalanceCurrent=tBalanceSheet::model()->find(array(
				'condition'=>'parent_id = :account AND yearmonth_periode = :period',
				'params'=>array(':account'=>$_lraccount, ':period'=>$_curPeriod),
		));

		if ($modelBalanceCurrent == null) { //New Account on This Period
			$sql='INSERT INTO t_balance_sheet (parent_id, yearmonth_periode, type_balance_id, remark, budget, beginning_balance,debit,credit,end_balance) VALUES ('
			.$_lraccount.','
			.$_curPeriod.', 1, "Automated posted", 0,'
			.$_labarugi.',0,0,'
			//.$_debit.','
			//.$_credit.','
			.$_labarugi.')';
		} else {
			$_labarugi=$_labarugi+$modelBalanceCurrent->beginning_balance;

			$sql='UPDATE t_balance_sheet SET
			debit = 0,
			credit = 0,
			end_balance = '.$_labarugi .'
			WHERE yearmonth_periode = '.$_curPeriod.' AND parent_id = '.$_lraccount;
		}

		$command=Yii::app()->db->createCommand($sql);

		$command->execute();

	}

	public function actionUnlock($id)
	{
		uJournal::model()->updateByPk((int)$id, array('state_id'=>2,'updated_date'=>time(),'updated_by'=>Yii::app()->user->id));
	}

	public function actionRePosting ()  //backup Posting only
	{
		$criteria=new CDbCriteria;
		$criteria->compare('state_id',99);
		$criteria->compare('yearmonth_periode',Yii::app()->settings->get("System", "cCurrentPeriod"));
		$models=uJournal::model()->findAll($criteria);

		foreach ($models as $model) {
			set_time_limit(0);  //
			$this->actionPosting($model->id);
		}

		Yii::app()->user->setFlash('success','<strong>Great!</strong> Reposting finished..');
		$this->redirect(array('/m1/default'));

	}

	public function actionPosting($id)
	{
		$_curPeriod = Yii::app()->settings->get("System", "cCurrentPeriod");
		$_lastPeriod = sParameter::cBeginDateBefore(Yii::app()->settings->get("System", "cCurrentPeriod"));

		uJournal::model()->updateByPk((int)$id, array('state_id'=>4,'updated_date'=>time(),'updated_by'=>Yii::app()->user->id));

		$models=uJournalDetail::model()->with('journal')->findAll(array(
				'condition'=>'parent_id = :id',
				'params'=>array(':id'=>$id),
		));

		foreach ($models as $model)
		{
			$modelBalanceCurrent=tBalanceSheet::model()->find(array(
					'condition'=>'parent_id =  :accid AND yearmonth_periode = :curperiod',
					'params'=>array(':accid'=>$model->account_no_id, ':curperiod'=>$_curPeriod),
			));

			$_debit=$model->debit;
			$_credit=$model->credit;
			$_endbalance=0;

			if ($modelBalanceCurrent == null) { //New Account on This Period. Create New Account on Current Period
				$modelBalanceLast=tBalanceSheet::model()->find(array(
						'condition'=>'parent_id = :accid AND yearmonth_periode = :period',
						'params'=>array(':accid'=>$model->account_no_id, ':period'=>$_lastPeriod),
				));

				if ($modelBalanceLast != null && $model->account->getTypeValue() == 1) {  //Account Neraca
					$_endbalance=$modelBalanceLast->end_balance;
				} else
					$_endbalance=0;

				if ($model->account->getSideValue() == 1 || isset($model->account->reverse)) { //Asset, Expense
					$_newendbalance=$_endbalance+$_debit-$_credit;
				} else { //Pasiva, Income
					$_newendbalance=$_endbalance+$_credit-$_debit;
				}

				$command=Yii::app()->db->createCommand('
						INSERT INTO t_balance_sheet (parent_id, yearmonth_periode, type_balance_id, remark, budget, beginning_balance,debit,credit,end_balance) VALUES (\':acc\',:curp, 1, \'Automated posted\', 0,:endb,:debit,:credit,:neweb)
						');
				$command->bindParam(":acc", $model->account_no_id, PDO::PARAM_STR);
				$command->bindParam(":curp", $_curPeriod, PDO::PARAM_STR);
				$command->bindParam(":endb", $_endbalance, PDO::PARAM_STR);
				$command->bindParam(":debit", $_debit, PDO::PARAM_STR);
				$command->bindParam(":credit", $_credit, PDO::PARAM_STR);
				$command->bindParam(":neweb", $_newendbalance, PDO::PARAM_STR);
				$command->execute();

			} else  {  //Update Current Record
					
				$_udebit = Yii::app()->db->createCommand('
						SELECT Sum(b.debit) AS sdebit
						FROM u_journal a
						INNER JOIN u_journal_detail b ON a.id = b.parent_id
						GROUP BY a.yearmonth_periode, a.state_id, b.account_no_id
						HAVING a.state_id=4 AND a.yearmonth_periode='.$_curPeriod.' AND b.account_no_id =\''.$model->account_no_id.'\';
						')->queryScalar();

				$_ucredit = Yii::app()->db->createCommand('
						SELECT Sum(b.credit) AS scredit
						FROM u_journal a
						INNER JOIN u_journal_detail b ON a.id = b.parent_id
						GROUP BY a.yearmonth_periode, a.state_id, b.account_no_id
						HAVING a.state_id=4 AND a.yearmonth_periode='.$_curPeriod.' AND b.account_no_id = \''.$model->account_no_id.'\';
						')->queryScalar();

				$_curdebit=($_udebit !=null) ? $_udebit : 0;
				$_curcredit=($_ucredit !=null) ? $_ucredit : 0;
				$_curbalance=$modelBalanceCurrent->beginning_balance;

				if ($model->account->getSideValue() == 1 || isset($model->account->reverse)) { //Asset, Expense
					$_endbalance=$_curbalance+$_curdebit-$_curcredit;
				} else { //Pasiva, Income
					$_endbalance=$_curbalance+$_curcredit-$_curdebit;
				}

				$command=Yii::app()->db->createCommand('
						UPDATE  t_balance_sheet SET
						debit = '.$_curdebit.',
						credit = '.$_curcredit.',
						end_balance = '.$_endbalance.'
						WHERE yearmonth_periode = '.$_curPeriod.' AND parent_id = '.$model->account_no_id.';');

				$command->execute();

				//LOG
				$commandLog=Yii::app()->db->createCommand('
						INSERT INTO t_balance_sheet_log (journal_id, yearmonth_periode, type_balance_id, remark, budget, account_no_id, beginning_balance,debit,credit,end_balance,created_date, created_by) VALUES ('
						.$model->parent_id.','
						.$_curPeriod.', 1, \'UPDATE LOG\', 0,'
						.$model->account_no_id.','
						.$_curbalance.','
						.$_debit.','
						.$_credit.','
						.$_endbalance.','
						.time().',
						\'1\')
						');

				$commandLog->execute();

			}
		}

		//balancing
		$this->labarugiExecution();
	}

	public function actionUnposting($id)
	{
		$_curPeriod = Yii::app()->settings->get("System", "cCurrentPeriod");
		$_lastPeriod = sParameter::cBeginDateBefore(Yii::app()->settings->get("System", "cCurrentPeriod"));

		$locked=uJournal::model()->updateByPk((int)$id, array('state_id'=>2,'updated_date'=>time(),'updated_by'=>Yii::app()->user->id));

		$models=uJournalDetail::model()->with('journal')->findAll(array(
				'condition'=>'parent_id = :id',
				'params'=>array(':id'=>$id),
		));

		foreach ($models as $model)
		{
			$modelBalanceCurrent=tBalanceSheet::model()->find(array(
					'condition'=>'parent_id = :accid AND yearmonth_periode = :period',
					'params'=>array(':accid'=>$model->account_no_id, ':period'=>$_curPeriod),
			));

			$_debit=$model->debit;
			$_credit=$model->credit;
			$_endbalance=0;

			$_curdebit=$modelBalanceCurrent->debit-$_debit;
			$_curcredit=$modelBalanceCurrent->credit-$_credit;
			$_curbalance=$modelBalanceCurrent->end_balance;

			if ($model->account->getSideValue() == 1 || isset($model->account->reverse)) { //Asset, Expense
				$_endbalance=$_curbalance-$_debit+$_credit;
			} else { //Pasiva, Income
				$_endbalance=$_curbalance-$_credit+$_debit;
			}

			$command=Yii::app()->db->createCommand('
					UPDATE  t_balance_sheet SET
					debit = '.$_curdebit.',
					credit = '.$_curcredit.',
					end_balance = '.$_endbalance.'
					WHERE yearmonth_periode = '.$_curPeriod.' AND parent_id = '.$model->account_no_id);

			$command->execute();

			//LOG
			$commandLog=Yii::app()->db->createCommand('
					INSERT INTO t_balance_sheet_log (journal_id, yearmonth_periode, type_balance_id, remark, budget, account_no_id, beginning_balance,debit,credit,end_balance) VALUES ('
					.$model->parent_id.','
					.$_curPeriod.', 1, \'UNPOSTING LOG\', 0,'
					.$model->account_no_id.','
					.$_curbalance.','
					.$_debit.','
					.$_credit.','
					.$_endbalance.')
					');

			$commandLog->execute();
		}
	}

	public function actionIndex($acc=null)
	{
		$model=new uJournal('search');
		$model->unsetAttributes();

		$criteria=new CDbCriteria;
		$criteria1=new CDbCriteria;
		$criteria->condition='state_id = 1 OR state_id = 2';
		//$criteria->compare('updated_by',4);

		if(isset($_GET['uJournal'])) {
			$model->attributes=$_GET['uJournal'];

			$criteria1->compare('system_ref',$_GET['uJournal']['system_ref'],true,'OR');
			$criteria1->compare('remark',$_GET['uJournal']['system_ref'],true,'OR');
		}

		if(isset($_GET['acc'])) {
			$criteria->with=array('journalDetail');
			$criteria->group='t.id, module_id, input_date, yearmonth_periode, system_ref, state_id';
			$criteria->join='INNER JOIN u_journal_detail tt ON t.id = tt.parent_id';
			$criteria->compare('tt.account_no_id',$_GET['acc']);
		}

		$criteria->compare('yearmonth_periode',Yii::app()->settings->get("System", "cCurrentPeriod"));
		$criteria->limit=30;

		$criteria->mergeWith($criteria1);

		//$dataProvider=new CActiveDataProvider('uJournal', array(
		$dataProvider=new EActiveDataProviderEx('uJournal', array(
				'cache' => array(3600),
				'criteria'=>$criteria,
				'pagination'=>array (
						'pageSize'=>20,
				)
		));

		$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
		));
	}

	public function actionIndexUnPost($acc=null)
	{
		$model=new uJournal('search');
		$model->unsetAttributes();  // clear any default values

		$criteria=new CDbCriteria;
		$criteria1=new CDbCriteria;
		$criteria->condition='state_id =4 or state_id = 3';
		$criteria->order = 't.updated_date DESC'; //last updated
		//$criteria->compare('journal_type_id',4);

		if(isset($_GET['uJournal'])) {
			$model->attributes=$_GET['uJournal'];

			$criteria1->compare('system_ref',$_GET['uJournal']['system_ref'],true,'OR');
			$criteria1->compare('remark',$_GET['uJournal']['system_ref'],true,'OR');
		}

		if(isset($_GET['acc'])) {
			$criteria->with=array('journalDetail');
			$criteria->group='t.id, module_id, input_date, yearmonth_periode, system_ref, state_id';
			$criteria->join='INNER JOIN u_journal_detail tt ON t.id = tt.parent_id';
			$criteria->compare('tt.account_no_id',$_GET['acc']);
		}

		$criteria->limit=20;

		$criteria->mergeWith($criteria1);

		//$dataProvider=new CActiveDataProvider('uJournal', array(
		$dataProvider=new EActiveDataProviderEx('uJournal', array(
				'cache' => array(3600),
				'criteria'=>$criteria,
				'pagination'=>array (
						'pageSize'=>20,
				)
		));

		$this->render('indexUnpost',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$model=$this->loadModel($id);

		if ($model->state_id ==4) {
			Yii::app()->user->setFlash("error","<strong>Error!</strong> Journal cannot be deleted. It has been posted...");
		}

		$model->delete();
	}

	public function loadModel($id)
	{
		$model=uJournal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionPostingAutoComplete()
	{
		$res =array();
		if (isset($_GET['term'])) {
			$qtxt =
			"SELECT system_ref FROM u_journal WHERE system_ref LIKE :name ORDER BY system_ref LIMIT 20";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":name", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			$res =$command->queryColumn();

		}
		echo CJSON::encode($res);
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='t-account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
