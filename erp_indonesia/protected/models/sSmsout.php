<?php

/**
 * This is the model class for table "s_smsout".
 *
 * The followings are the available columns in table 's_smsout':
 * @property string $id
 * @property string $sender_id
 * @property integer $modem
 * @property string $message
 * @property string $created_date
 */
class sSmsout extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SSmsout the static model class
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
		return 's_smsout';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('sender_id, message, created_date', 'required'),
				array('modem', 'numerical', 'integerOnly'=>true),
				array('sender_id, receivergroup_id, created_date', 'length', 'max'=>11),
				array('message', 'length', 'max'=>1000),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, sender_id, modem, message, created_date', 'safe', 'on'=>'search'),
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
				'sender_id' => 'Sender',
				'receivergroup_id' => 'Receiver Group',
				'modem' => 'Modem',
				'message' => 'Message',
				'created_date' => 'Created Date',
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
		$criteria->compare('sender_id',$this->sender_id,true);
		$criteria->compare('modem',$this->modem);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->order='created_date DESC';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}