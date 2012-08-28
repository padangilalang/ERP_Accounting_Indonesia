<?php

/**
 * This is the model class for table "c_timeblock".
 *
 * The followings are the available columns in table 'c_timeblock':
 * @property integer $id
 * @property string $code
 * @property string $in
 * @property string $out
 * @property string $rest_in
 * @property string $rest_out
 */
class gParamTimeblock extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CTimeblock the static model class
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
		return 'g_param_timeblock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('code', 'length', 'max'=>25),
				array('in, out, rest_in, rest_out', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, code, in, out, rest_in, rest_out', 'safe', 'on'=>'search'),
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
				'code' => 'Code',
				'in' => 'In',
				'out' => 'Out',
				'rest_in' => 'Rest In',
				'rest_out' => 'Rest Out',
				'remark' => 'Remark',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('in',$this->in,true);
		$criteria->compare('out',$this->out,true);
		$criteria->compare('rest_in',$this->rest_in,true);
		$criteria->compare('rest_out',$this->rest_out,true);

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}

	private static $_items=array();

	/////////////////////////////////////////////////////////////
	/**
	 * Returns the items for the specified type.
	 * @param string item type (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	 */
	public static function items($type)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
				'order'=>'code',
				//	'params'=>array(':type'=>$type),
		));
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->code . " (". $model->in . " - ". $model->out .")";
	}


}