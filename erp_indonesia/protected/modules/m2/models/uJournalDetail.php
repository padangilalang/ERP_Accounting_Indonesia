<?php

class uJournalDetail extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'u_journal_detail';
	}

	public function rules()
	{
		return array(
				array('account_no_id, debit, credit', 'required'),
				array('sub_account_id', 'numerical', 'integerOnly'=>true),
				array('account_no_id, sub_account_id, debit, credit, user_remark, system_remark', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'account'=>array(self::BELONGS_TO, 'tAccount', array('account_no_id'=>'id')),
				'journal'=>array(self::BELONGS_TO, 'uJournal', 'parent_id'),
				'purchasing'=>array(self::BELONGS_TO, 'vPurchasing', 'sub_account_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'account_no_id' => 'Account No',
				'sub_account_id' => 'Sub Account',
				'debit' => 'Debit',
				'credit' => 'Credit',
				'user_remark' => 'User Remark',
				'system_remark' => 'System Remark',
				'created_date' => 'Created Date',
				'created_by' => 'Created',
				'updated_date' => 'Updated Date',
				'updated_by' => 'Updated',
		);
	}

	public function search($id=0)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function searchByAccount($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('user_remark',$this->user_remark,true);
		$criteria->compare('account_no_id',$id);
		$criteria->with=('journal');
		$criteria->compare('yearmonth_periode',Yii::app()->settings->get("System", "cCurrentPeriod"));

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>100,
				),
				//'pagination'=>false,
				'sort'=>array(
						'defaultOrder'=>'input_date,journal.id',
				),
		));
	}

	public static function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->user_ref, 'label' => $model->user_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->user_ref, 'label' => $model->user_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopRelated($name) {

		//$_related = self::model()->find((int)$id)->account_name;
		$_exp=explode(" ",$name);


		$criteria=new CDbCriteria;

		if (isset($_exp[0]))
			$criteria->compare('user_ref',$_exp[0],true,'OR');

		if (isset($_exp[1]))
			$criteria->compare('user_ref',$_exp[1],true,'OR');
			
		$criteria->limit=10;
		$criteria->order='updated_date DESC';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->account_no . " ".$model->account_name, 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}


}