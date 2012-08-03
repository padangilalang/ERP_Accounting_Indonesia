<?php

class tBalanceSheet extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 't_balance_sheet';
	}

	public function rules()
	{
		return array(
				array('yearmonth_periode, type_balance_id, beginning_balance, debit, credit, end_balance, created_date, created_id', 'numerical', 'integerOnly'=>true),
				array('remark', 'length', 'max'=>50),
				array('id, parent_id, input_date, yearmonth_periode, type_balance_id, remark, balance, created_date, created_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'account' => array(self::BELONGS_TO, 'tAccount', 'parent_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'yearmonth_periode' => 'Periode',
				'type_balance_id' => 'Type Balance',
				'remark' => 'Remark',
				'budget' => 'Budget',
				'beginning_balance' => 'Begin Balance',
				'debit' => 'Debit',
				'credit' => 'Credit',
				'end_balance' => 'End Balance',
				'created_date' => 'Created Date',
				'created_id' => 'Created',
		);
	}

	public function search($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>50,
				),
				'sort'=>array(
						'defaultOrder'=>'type_balance_id,yearmonth_periode',
				),
		));
	}

	public function debitf() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->debit);

		return $_format;
	}

	public function creditf() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->credit);

		return $_format;
	}

	public function beginf() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->beginning_balance);

		return $_format;
	}

	public function endf() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->end_balance);

		return $_format;
	}

	public function behaviors()
	{
		return array(
				'datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'),
				'defaults'=>array(
						'class'=>'ext.decimali18nbehavior.DecimalI18NBehavior',
						//'format'=>'db',
				),
				//'ActiveRecordLogableBehavior'=>array('class'=>'ext.ActiveRecordLogableBehavior'),
		);
	}


}