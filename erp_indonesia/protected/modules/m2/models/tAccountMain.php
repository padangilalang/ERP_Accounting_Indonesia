<?php

class tAccountMain extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 't_account__main';
	}

	public function rules()
	{
		return array(
				array('name, position_id', 'required'),
				array('position_id', 'numerical', 'integerOnly'=>true),
				array('name', 'length', 'max'=>128),
				array('id, name, position_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'account_list' => array(self::HAS_MANY, 'tAccountProperties','mvalue','condition'=>'mkey = \'accmain_id\''),
				'account_name' => array(self::HAS_ONE, 'tAccount','account_list.parent_id','through'=>'account_list'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'name' => 'Name',
				'position_id' => 'Position',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('position_id',$this->position_id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}


	public static function items()
	{
		$models=self::model()->findAll(array(
		));
		foreach($models as $model)
			$_items[$model->id]=$model->name;

		return $_items;
	}


}