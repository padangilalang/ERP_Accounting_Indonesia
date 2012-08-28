<?php

class sNotification3 extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_notification';
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
				'commentCount' => array(self::STAT, 'sNotificationDetail', 'parent_id'),
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

	public function searchFilter3()
	{
		$criteria1=new CDbCriteria;

		$criteria1->compare('receiver_id',Yii::app()->user->id,false,'OR');
		$criteria1->compare('sender_id',Yii::app()->user->id,false,'OR');

		$criteria=new CDbCriteria;
		$criteria->mergeWith($criteria1);
		$criteria->compare('type_id',3);
		$criteria->addNotInCondition('read_id',array(6));
		$criteria->order='sender_date DESC';

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>5,
				),
		));
	}

}