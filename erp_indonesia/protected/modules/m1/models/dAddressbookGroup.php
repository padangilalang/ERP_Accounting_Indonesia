<?php

/**
 * This is the model class for table "s_usersms_group".
 *
 * The followings are the available columns in table 's_usersms_group':
 * @property string $id
 * @property string $parent_id
 * @property string $group_name
 * @property string $description
 */
class dAddressbookGroup extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SUsersmsGroup the static model class
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
		return 'd_addressbook_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id', 'required'),
				array('parent_id', 'length', 'max'=>20),
				array('group_name', 'length', 'max'=>25),
				array('description', 'length', 'max'=>255),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, group_name, description', 'safe', 'on'=>'search'),
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
				'group_name' => 'Group Name',
				'description' => 'Description',
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
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
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

	public static function items($type='ALL')
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems($type='ALL')
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
				'order'=>'id',
				//	'params'=>array(':type'=>$type),
		));
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->group_name;
	}



}