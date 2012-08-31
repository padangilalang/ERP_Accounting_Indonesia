<?php

class uJournal extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'u_journal';
	}

	public function rules()
	{
		return array(
				array('input_date, yearmonth_periode', 'required'),
				array('entity_id, module_id, yearmonth_periode, journal_type_id, state_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly'=>true),
				array('user_ref, system_ref', 'length', 'max'=>100),
				array('cb_receiver', 'length', 'max'=>50),
				array('remark', 'safe'),
				array('id, entity_id, module_id, input_date, yearmonth_periode, user_ref, system_ref, remark, journal_type_id, state_id, cb_receiver, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'journalCount' => array(self::STAT, 'uJournalDetail', 'parent_id'),
				'journalSum' => array(self::STAT, 'uJournalDetail', 'parent_id','select'=>'sum(debit)'),
				'journalSumCek' => array(self::STAT, 'uJournalDetail', 'parent_id','select'=>'sum(credit)'),
				'journalDetail' => array(self::HAS_MANY, 'uJournalDetail', 'parent_id'),
				'journal_many' => array(self::MANY_MANY, 'tAccount', 'u_journal_detail(parent_id,account_no_id)'),
				'status' => array(self::HAS_ONE, 'sParameter', array('code'=>'state_id'),'condition'=>'type = \'cStatusJ\''),
				'module' => array(self::HAS_ONE, 'sParameter', array('code'=>'module_id'),'condition'=>'type = \'cModule\''),
				'entity' => array(self::BELONGS_TO, 'aOrganization', array('entity_id'=>'id')),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'entity_id' => 'Entity',
				'module_id' => 'Module',
				'input_date' => 'Input Date',
				'yearmonth_periode' => 'Periode',
				'user_ref' => 'User Ref',
				'system_ref' => 'System Ref',
				'remark' => 'Remark / Tag',
				'journal_type_id' => 'Journal Type',
				'state_id' => 'State',
				'cb_receiver' => 'Cb Receiver',
				'created_date' => 'Created Date',
				'created_by' => 'Created',
				'updated_date' => 'Updated Date',
				'updated_by' => 'Updated',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('yearmonth_periode',Yii::app()->settings->get("System", "cCurrentPeriod"));
		$criteria->compare('state_id!',4);
		$criteria->order='input_date';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=> array(
						'pageSize'=>50,
				),
		));
	}

	public function searchTagPurchasing($tag)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('remark',$tag,true);
		$criteria->compare('journal_type_id',1);

		$model=self::find($criteria);

		return $model;
	}

	public function searchTagPayment($tag)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('remark',$tag);
		$criteria->compare('journal_type_id',2);

		$model=self::find($criteria);

		return $model;
	}

	public static function getTopCreated($mid=null) {

		$criteria=new CDbCriteria;
		$criteria->limit=10;
		$criteria->order='created_date DESC';
		$criteria->compare('module_id',$mid);
		if (Yii::app()->user->name != "admin") {
			$criteria->addInCondition('entity_id',sUser::model()->getGroupArray());
		}


		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->system_ref, 'label' => '...'.substr($model->system_ref,strlen($model->system_ref)-15,15), 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated($mid=null) {

		$criteria=new CDbCriteria;
		$criteria->limit=10;
		$criteria->order='updated_date DESC';
		$criteria->compare('module_id',$mid);
		if (Yii::app()->user->name != "admin") {
			$criteria->addInCondition('entity_id',sUser::model()->getGroupArray());
		}


		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			if ($model->module_id == 1) {
				$returnarray[] = array('id' => $model->system_ref, 'label' => '...'.substr($model->system_ref,strlen($model->system_ref)-15,15), 'icon'=>'list-alt', 'url' => array('/m2/uJournal/view','id'=>$model->id));
			} else {
				$returnarray[] = array('id' => $model->system_ref, 'label' => '...'.substr($model->system_ref,strlen($model->system_ref)-15,15), 'icon'=>'list-alt', 'url' => array('/m2/mCashbank/view','id'=>$model->id));
					
			}

		}

		return $returnarray;
	}

	public static function getTopRelated($name) {

		$_exp=explode(" ",$name);


		$criteria=new CDbCriteria;
		if (Yii::app()->user->name != "admin") {
			$criteria->addInCondition('entity_id',sUser::model()->getGroupArray());
		}


		if (isset($_exp[0]))
			$criteria->compare('user_ref',$_exp[0],true,'OR');

		if (isset($_exp[1]))
			$criteria->compare('user_ref',$_exp[1],true,'OR');
			
		$criteria->limit=10;
		$criteria->order='updated_date DESC';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->account_no . " ".$model->account_name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	protected function afterDelete()
	{
		$log=new zArLog;
		$log->description=  'User ' . Yii::app()->user->Name . ' deleted '
		. get_class($this->Owner)
		. '[' . $this->system_ref .'].';
		$log->action=       'DELETE';
		$log->model=        get_class($this->Owner);
		$log->idModel=      $this->Owner->getPrimaryKey();
		$log->field=        '';
		$log->creationdate= new CDbExpression('NOW()');
		$log->userid=       Yii::app()->user->id;
		$log->save();

		uJournalDetail::model()->deleteAll(array(
				'condition'=>'parent_id = :parent',
				'params'=>array(':parent'=>$this->id),
		));
		return true;
	}

	public function journalSumF() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->journalSum);

		return $_format;
	}

	public function system_reff() {
		$_state=null;

		if ($this->state_id != 1)
			$_state = " (" .$this->status->name .")";
			
		$_format=$this->system_ref .$_state;

		return $_format;
	}

	public function getStatus() {

		if ($this->state_id == 1)
			$_state = " (" .sParameter::item("cStatus",$this->state_id) .")";
			
		$_format=$this->system_ref .$_state;

		return $_format;
	}

}
