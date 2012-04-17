<?php

class CProductCategory extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'c_product_category';
	}

	public function rules()
	{
		return array(
				array('parent_id', 'numerical', 'integerOnly'=>true),
				array('inventory_type', 'length', 'max'=>150),
				array('remarks', 'length', 'max'=>500),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, inventory_type, remarks', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'inventory_type' => 'Inventory Type',
				'remarks' => 'Remarks',
		);
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('inventory_type',$this->inventory_type,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}