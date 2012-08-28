<?php

/**
 * This is the model class for table "b_supplier".
 *
 * The followings are the available columns in table 'b_supplier':
 * @property string $id
 * @property integer $gid
 * @property string $parent_id
 * @property string $person_incharge
 * @property string $company_name
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $address4
 * @property string $pos_code
 * @property integer $province_id
 * @property string $phone
 * @property string $fax
 * @property string $handphone
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class bSupplier extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BSupplier the static model class
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
		return 'b_supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('created_date, created_by, updated_date, updated_by', 'required'),
				array('gid, province_id, created_date, updated_date', 'numerical', 'integerOnly'=>true),
				array('parent_id', 'length', 'max'=>11),
				array('person_incharge', 'length', 'max'=>40),
				array('company_name, phone, fax, handphone', 'length', 'max'=>50),
				array('address1', 'length', 'max'=>100),
				array('address2', 'length', 'max'=>20),
				array('address3, address4', 'length', 'max'=>30),
				array('pos_code', 'length', 'max'=>7),
				array('created_by, updated_by', 'length', 'max'=>15),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, gid, parent_id, person_incharge, company_name, address1, address2, address3, address4, pos_code, province_id, phone, fax, handphone, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'gid' => 'Gid',
				'parent_id' => 'Parent',
				'person_incharge' => 'Person Incharge',
				'company_name' => 'Supplier Name',
				'address1' => 'Address1',
				'address2' => 'Address2',
				'address3' => 'Address3',
				'address4' => 'Address4',
				'pos_code' => 'Pos Code',
				'province_id' => 'Province',
				'phone' => 'Phone',
				'fax' => 'Fax',
				'handphone' => 'Handphone',
				'created_date' => 'Created Date',
				'created_by' => 'Created By',
				'updated_date' => 'Updated Date',
				'updated_by' => 'Updated By',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('gid',$this->gid);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('person_incharge',$this->person_incharge,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('address3',$this->address3,true);
		$criteria->compare('address4',$this->address4,true);
		$criteria->compare('pos_code',$this->pos_code,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('handphone',$this->handphone,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}

	//////////////////////////////////////////////
	private static $_items=array();

	public static function items($parentid,$all=0)
	{
		if(!isset(self::$_items[$parentid]))
			self::loadItems($parentid,$all);
		return self::$_items[$parentid];
	}

	private static function loadItems($parentid,$all=0)
	{
		self::$_items[$parentid]=array();
		$models=self::model()->findAll(array(
				'condition'=>'parent_id=:parentid',
				'params'=>array(':parentid'=>$parentid),
		));

		if ($all ==1)
			self::$_items[$parentid]['']='(ALL)';

		foreach($models as $model)
			self::$_items[$parentid][$model->id]=$model->company_name;
	}

}