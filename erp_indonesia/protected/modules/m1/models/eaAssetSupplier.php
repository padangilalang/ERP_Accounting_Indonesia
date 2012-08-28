<?php

/**
 * This is the model class for table "ea_asset_supplier".
 *
 * The followings are the available columns in table 'ea_asset_supplier':
 * @property integer $id
 * @property string $supplier_name
 * @property string $telpon
 * @property string $fax
 * @property string $remarks
 */
class eaAssetSupplier extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EaAssetSupplier the static model class
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
		return 'ea_asset_supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('supplier_name', 'required'),
				array('supplier_name', 'length', 'max'=>150),
				array('telpon, fax', 'length', 'max'=>50),
				array('remarks', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, supplier_name, telpon, fax, remarks', 'safe', 'on'=>'search'),
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
				'supplier_name' => 'Supplier Name',
				'telpon' => 'Telpon',
				'fax' => 'Fax',
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
		$criteria->compare('supplier_name',$this->supplier_name,true);
		$criteria->compare('telpon',$this->telpon,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}