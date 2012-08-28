<?php

class tAccountProperties extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 't_account__properties';
	}

	public function rules()
	{
		return array(
				array('parent_id, mkey, mvalue', 'required'),
				array('parent_id, mvalue', 'numerical', 'integerOnly'=>true),
				array('mkey, mtext', 'length', 'max'=>15),
				array('parent_id, mkey, mvalue', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'parentAccount' => array(self::BELONGS_TO, 'tAccountMain', 'mvalue'),
				'getparent' => array(self::BELONGS_TO, 'tAccount', 'parent_id'),
				'currencyName' => array(self::BELONGS_TO, 'sParameter', array('mvalue'=>'code'),'condition'=>'type=\'cCurrency\''),
				'stateName' => array(self::BELONGS_TO, 'sParameter', array('mvalue'=>'code'),'condition'=>'type=\'cStatusP\''),
				'childName' => array(self::BELONGS_TO, 'sParameter', array('mvalue'=>'code'),'condition'=>'type=\'cHasChild\''),
		);
	}

	public function attributeLabels()
	{
		return array(
				'parent_id' => 'Parent',
				'mkey' => 'Mkey',
				'mvalue' => 'Mvalue',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('mkey',$this->mkey,true);
		$criteria->compare('mvalue',$this->mvalue);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function setMvalue(){
		if ($this->mvalue ==0 ) {
			$_myval='*Inherited*';
		} elseif ($this->mvalue ==1) {
			$_myval='Yes';
		} else
			$_myval='Non Active (or Not Set)';
			
		return $_myval;
	}

}