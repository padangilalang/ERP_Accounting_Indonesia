<?php

class tAccountReport extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 't_account_report';
	}

	public function rules()
	{
		return array(
				array('parent_id, sort, title, description, link', 'required'),
				array('sort', 'numerical', 'integerOnly'=>true),
				array('parent_id', 'length', 'max'=>20),
				array('title', 'length', 'max'=>50),
				array('description', 'length', 'max'=>100),
				array('link', 'length', 'max'=>255),
				array('id, parent_id, sort, title, description, link', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'getparent' => array(self::BELONGS_TO, 'tAccountReport', 'parent_id'),
				'childs' => array(self::HAS_MANY, 'tAccountReport', 'parent_id', 'order' => 'id ASC'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'sort' => 'Sort',
				'title' => 'Title',
				'description' => 'Description',
				'link' => 'Link',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id!',0);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public static function accountReportList()
	{
		$_items[]=array();

		$models=self::model()->findAll('parent_id !=0');


		foreach($models as $model) {
			$_items[$model->getparent->title][$model->id]=$model->title;
		}

		return $_items;

	}


}