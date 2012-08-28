<?php

/**
 * This is the model class for table "ea_asset_category".
 *
 * The followings are the available columns in table 'ea_asset_category':
 * @property integer $id
 * @property integer $parent_id
 * @property string $inventory_type
 * @property string $type1_info
 * @property string $type2_info
 * @property string $remarks
 */
class eaAssetCategory extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EaAssetCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ea_asset_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id', 'numerical', 'integerOnly'=>true),
				array('inventory_type', 'length', 'max'=>150),
				array('type1_info, type2_info', 'length', 'max'=>50),
				array('remarks', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, inventory_type, type1_info, type2_info, remarks', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'inventory_type' => 'Inventory Type',
				'type1_info' => 'Type1 Info',
				'type2_info' => 'Type2 Info',
				'remarks' => 'Remarks',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('inventory_type',$this->inventory_type,true);
		$criteria->compare('type1_info',$this->type1_info,true);
		$criteria->compare('type2_info',$this->type2_info,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function mainsearch()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',0);
		$criteria->compare('inventory_type',$this->inventory_type,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

}