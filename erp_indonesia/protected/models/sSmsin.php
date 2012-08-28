<?php

class sSmsin extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_smsin';
	}

	public function rules()
	{
		return array(
				array('filename, cfrom, sent, received, modem, message', 'required'),
				array('modem', 'numerical', 'integerOnly'=>true),
				array('filename, message', 'length', 'max'=>1000),
				array('cfrom', 'length', 'max'=>50),
				array('reply_id', 'length', 'max'=>20),
				array('filename, cfrom, message', 'safe', 'on'=>'search'),
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
				'filename' => 'Filename',
				'cfrom' => 'From',
				'sent' => 'Sent',
				'received' => 'Received',
				'modem' => 'Modem',
				'message' => 'Message',
				'reply_id' => 'Reply',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('cfrom',$this->cfrom,true);
		$criteria->compare('sent',$this->sent,true);
		$criteria->compare('received',$this->received,true);
		$criteria->compare('modem',$this->modem);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}
}