<?php

class sMatrix extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_matrix';
	}

	public function rules()
	{
		return array(
				array('level, level_r, level_c, level_u, level_d', 'required'),
				array('level_r, level_c, level_u, level_d', 'numerical', 'integerOnly'=>true),
				array('level', 'length', 'max'=>25),
				array('id, level, level_r, level_c, level_u, level_d', 'safe', 'on'=>'search'),
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
				'level' => 'Level',
				'level_r' => 'Level R',
				'level_c' => 'Level C',
				'level_u' => 'Level U',
				'level_d' => 'Level D',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('level_r',$this->level_r);
		$criteria->compare('level_c',$this->level_c);
		$criteria->compare('level_u',$this->level_u);
		$criteria->compare('level_d',$this->level_d);

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}

	private static $_items=array();

	public static function items($type)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}

	private static function loadItems($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
		));
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->level;
	}
}