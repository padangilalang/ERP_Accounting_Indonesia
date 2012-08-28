<?php

/**
 * This is the model class for table "d_addressbook".
 *
 * The followings are the available columns in table 'd_addressbook':
 * @property string $id
 * @property string $complete_name
 * @property string $company_name
 * @property string $title
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $handphone
 * @property string $email
 */
class dAddressbook extends BaseModel
{

	public $defaultgroup;

	/**
	 * Returns the static model of the specified AR class.
	 * @return DAddressbook the static model class
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
		return 'd_addressbook';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('complete_name', 'length', 'max'=>50),
				array('company_name, title', 'length', 'max'=>100),
				array('address1, address2, address3, handphone, email', 'length', 'max'=>255),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, complete_name, company_name, title, address1, address2, address3, handphone, email', 'safe', 'on'=>'search'),
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
				'complete_name' => 'Complete Name',
				'company_name' => 'Company Name',
				'title' => 'Title',
				'address1' => 'Address1',
				'address2' => 'Address2',
				'address3' => 'Address3',
				'handphone' => 'Handphone',
				'email' => 'Email',
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
		$criteria->compare('complete_name',$this->complete_name,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('address3',$this->address3,true);
		$criteria->compare('handphone',$this->handphone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->order='id DESC';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>25,
				),
		));
	}


	/////////////////////////////////////////////////////////////
	/**
	* Returns the items for the specified type.
	* @param string item type (e.g. 'PostStatus').
	* @return array item names indexed by item code. The items are order by their position values.
	* An empty array is returned if the item type does not exist.
	*/
	private static $_items=array();

	public static function items($type="ALL")
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems($type="ALL")
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
				'order'=>'sort',
				//	'params'=>array(':type'=>$type),
		));
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->group_name;
	}

}