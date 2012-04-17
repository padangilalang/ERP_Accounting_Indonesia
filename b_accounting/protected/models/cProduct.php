<?php

class cProduct extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'c_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('category_id', 'required'),
				array('category_id, created_date, created_id, updated_date, updated_id', 'numerical', 'integerOnly'=>true),
				array('item, brand, type, serial_number', 'length', 'max'=>100),
				array('remark, photo_path', 'length', 'max'=>500),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, category_id, item, brand, type, serial_number, remark, photo_path, created_date, created_id, updated_date, updated_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'category_id' => 'Category',
				'item' => 'Item',
				'brand' => 'Brand',
				'type' => 'Type',
				'serial_number' => 'Serial Number',
				'remark' => 'Remark',
				'photo_path' => 'Photo Path',
				'created_date' => 'Created Date',
				'created_id' => 'Created',
				'updated_date' => 'Updated Date',
				'updated_id' => 'Updated',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('serial_number',$this->serial_number,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('photo_path',$this->photo_path,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('created_id',$this->created_id);
		$criteria->compare('updated_date',$this->updated_date);
		$criteria->compare('updated_id',$this->updated_id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}


	public static function items()
	{
		$_items=array();

		$models=self::model()->findAll(array());

		foreach($models as $model)
			$_items[$model->id]=$model->item;

		return $_items;
	}

}