<?php

class tAccountEntity extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 't_account_entity';
	}

	public function rules()
	{
		return array(
				array('parent_id, entity_id, state_id', 'required'),
				array('parent_id, entity_id, state_id, created_date, created_by', 'numerical', 'integerOnly'=>true),
				//array('parent_id', 'unique'),
				array('parent_id', 'UniqueAttributesValidator', 'with'=>'entity_id','message'=>'This Entity already inputed...'),
				array('remark', 'safe'),
				array('id, parent_id, entity_id, remark, state_id, created_date, created_by', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'entity' => array(self::BELONGS_TO, 'aOrganization', 'entity_id'),
				'account' => array(self::BELONGS_TO, 'tAccount', 'parent_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'entity_id' => 'Entity',
				'remark' => 'Remark',
				'state_id' => 'State',
				'created_date' => 'Created Date',
				'created_by' => 'Created',
		);
	}

	public function searchAccount($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function searchEntity($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('entity_id',$id);
		$criteria->with=array('account');
		$criteria->order=('account.account_no');
		$criteria->condition='account_no is not null';
		$criteria->group='account_no, account_name';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>100,
				),
		));
	}

}