<?php

class sModule extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_module';
	}

	public function rules()
	{
		return array(
				array('parent_id, sort, title', 'required'),
				array('parent_id', 'length', 'max'=>20),
				array('sort', 'numerical', 'integerOnly'=>true),
				array('title', 'length', 'max'=>50),
				array('description, image', 'length', 'max'=>100),
				array('link', 'length', 'max'=>255),
				array('id, parent_id, title, description, link', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'getparent' => array(self::BELONGS_TO, 'sModule', 'parent_id'),
				'childs' => array(self::HAS_MANY, 'sModule', 'parent_id', 'order' => 'id ASC'),
				'user' => array(self::HAS_MANY, 'sUserModule', 's_module_id'),
				'userList' => array(self::MANY_MANY, 'sUser','s_user_module(s_module_id,s_user_id)'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent ID',
				'sort' => 'Sort',
				'title' => 'Title',
				'description' => 'Description',
				'link' => 'Link',
				'image' => 'Image',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('link',$this->link,true);
		$criteria->order=('sort');

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}


	public function searchMenuImage()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',0);
		$criteria->order=('sort');

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}

	public static function items()
	{
		$_items=array();
		$models=self::model()->findAll(array(
				'order'=>'sort',
		));

		$_items[0]="(ROOT)";

		foreach($models as $model) {
			if ($model->childs)
				$_items[$model->id]=$model->sort.' - '.$model->title;
		}

		return $_items;
	}

	public static function itemsAll()
	{
		$_items=array();
		$models=self::model()->findAll(array(
				'order'=>'sort',
		));

		$_items[0]="(ROOT)";

		foreach($models as $model) {
			$_items[$model->id]=$model->sort.' - '.$model->title;
		}

		return $_items;
	}

	public function findSort($id)
	{
		$model=$this->findByPk((int)$id);
		if ($model == null)
			return "All";
			
		return $model->sort;
	}



	public function searchUser($uid)
	{
		$rawData=Yii::app()->db->createCommand('SELECT  a.id,
				c.username, c.password, c.default_group, c.status_id , d.name
				FROM s_module a
				INNER JOIN s_user_module b ON a.id = b.s_module_id
				INNER JOIN s_user c ON b.s_user_id = c.id
				LEFT JOIN s_parameter d ON d.code = c.status_id AND d.type = "cStatus"
				where a.id = '.$uid )->queryAll() ;

		return new CArrayDataProvider($rawData, array(
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
	}

	public function getTopOther() {

		$models=self::model()->findAll(array('limit'=>10,'condition'=>'parent_id = 0'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->id, 'label' => $model->title, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}


}