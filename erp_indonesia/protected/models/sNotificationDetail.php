<?php

class sNotificationDetail extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_notification_detail';
	}

	public function rules()
	{
		return array(
				array('sender_date, type_id, broadcast_code, sender_id, receiver_date, receiver_id, receiver_ref, category_id, read_id', 'numerical', 'integerOnly'=>true),
				array('sender_ref', 'length', 'max'=>25),
				array('link', 'length', 'max'=>100),
				array('long_desc', 'length', 'max'=>250),
				array('id, sender_date, sender_id, sender_ref, receiver_date, receiver_id, receiver_ref, category_id, long_desc, link, read_id, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'broadcast_code' => 'Broadcast Code',
				'type_id' => 'Type',
				'sender_date' => 'Sender Date',
				'sender_id' => 'Sender',
				'sender_ref' => 'Sender Ref',
				'receiver_date' => 'Receiver Date',
				'receiver_id' => 'Receiver',
				'receiver_ref' => 'Receiver Ref',
				'category_id' => 'Category',
				'long_desc' => 'Message',
				'link' => 'Link',
				'read_id' => 'Read',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('sender_date',$this->sender_date);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('broadcast_code',$this->broadcast_code);
		$criteria->compare('sender_ref',$this->sender_ref,true);
		$criteria->compare('receiver_date',$this->receiver_date);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('receiver_ref',$this->receiver_ref);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('long_desc',$this->long_desc,true);
		$criteria->compare('link',$this->link);
		$criteria->compare('read_id',$this->read_id);

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}


	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord) {
				$this->sender_date=time();
				$this->read_id=1;
				//$this->type_id=1;
				$this->sender_id= yii::app()->user->id;
			}
			return true;
		}
		else
			return false;
	}

	public function nicetime($time) {
		$_mywaktu= new waktu;
		$_nicetime = $_mywaktu->nicetime($time);

		return $_nicetime;
	}

}