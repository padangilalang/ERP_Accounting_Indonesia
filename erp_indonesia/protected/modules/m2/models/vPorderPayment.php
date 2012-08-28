<?php

class vPorderPayment extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'v_porder_payment';
	}

	public function rules()
	{
		return array(
				array('parent_id, payment_date, payment_type_id, amount', 'required'),
				array('parent_id, payment_type_id, payment_source_id, created_date, updated_date', 'numerical', 'integerOnly'=>true),
				array('description', 'length', 'max'=>500),
				array('payment_ref', 'length', 'max'=>100),
				array('amount, created_by, updated_by', 'length', 'max'=>15),
				array('effective_date', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, payment_date, payment_type_id, description, amount, effective_date, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'payment_source' => array(self::BELONGS_TO, 'tAccount', 'payment_source_id'),
				'po' => array(self::BELONGS_TO, 'vPorder', 'parent_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'payment_date' => 'Payment Date',
				'payment_ref' => 'Payment Ref',
				'payment_source_id' => 'Payment Source',
				'payment_type_id' => 'Payment Type',
				'description' => 'Description',
				'amount' => 'Amount',
				'effective_date' => 'Effective Date',
				'created_date' => 'Created Date',
				'created_by' => 'Created By',
				'updated_date' => 'Updated Date',
				'updated_by' => 'Updated By',
		);
	}

	public function search($id)
	{

		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}


}