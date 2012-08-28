<?php

class sNotification extends CActiveRecord
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
				array('long_desc', 'required'),
				array('sender_date, type_id, broadcast_code, sender_id, receiver_date, receiver_id, receiver_ref, category_id, read_id', 'numerical', 'integerOnly'=>true),
				array('long_desc','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
				array('sender_ref', 'length', 'max'=>25),
				array('link', 'length', 'max'=>100),
				//array('long_desc', 'length', 'max'=>250),
				array('id, sender_date, sender_id, sender_ref, receiver_date, receiver_id, receiver_ref, category_id, long_desc, link, read_id, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'commentCount' => array(self::STAT, 'sNotificationDetail', 'parent_id'),
				'receiver' => array(self::BELONGS_TO, 'sUser', 'receiver_id'),
				'sender' => array(self::BELONGS_TO, 'sUser', 'sender_id'),

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

	public function searchFilter()
	{
		$criteria1=new CDbCriteria;

		$criteria1->compare('receiver_id',Yii::app()->user->id,false,'OR');
		$criteria1->compare('sender_id',Yii::app()->user->id,false,'OR');

		$criteria=new CDbCriteria;
		$criteria->mergeWith($criteria1);
		$criteria->compare('type_id',2);
		$criteria->addNotInCondition('read_id',array(6));
		$criteria->order='sender_date DESC';

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>5,
				),
		));
	}


	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord) {
				$this->sender_date=time();
				$this->sender_id= yii::app()->user->id;
					
			}
			return true;
		}
		else
			return false;
	}

	public function getCountComment($id)
	{
		$model=sNotificationDetail::model()->count(array(
				'condition'=>'parent_id = :id',
				'params'=>array(':id'=>$id),
		));
		if ($model == null) {
			return 0;
		} else {
			return $model;
		}
	}

	public function getTopCreated() {

		$criteria=new CDbCriteria;
		$criteria->limit=10;
		$criteria->order='sender_date DESC';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->id, 'label' => ($model->sender_ref !=null) ? $model->sender_ref : 'Message #'.$model->id, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopUpdated() {

		$criteria=new CDbCriteria;
		$criteria->limit=10;
		$criteria->order='receiver_date DESC';


		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->id, 'label' => ($model->sender_ref !=null) ? $model->sender_ref : 'Message #'.$model->id, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopRelated($name) {

		//$_related = self::model()->find((int)$id)->account_name;
		$_exp=explode(" ",$name);


		$criteria=new CDbCriteria;
		//$criteria->compare('name',$_related,true,'OR');

		if (isset($_exp[0]))
			$criteria->compare('name',$_exp[0],true,'OR');

		if (isset($_exp[1]))
			$criteria->compare('name',$_exp[1],true,'OR');
			
		$criteria->limit=10;
		$criteria->order='updated_date DESC';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function nicetime($time) {
		$_mywaktu= new waktu;
		$_nicetime = $_mywaktu->nicetime($time);

		return $_nicetime;
	}

	public function getUnreadNotification() {
		return self::count('read_id =1 and receiver_id = '.Yii::app()->user->id);
	}

}