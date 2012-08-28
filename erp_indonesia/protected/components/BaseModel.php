<?php

class BaseModel extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return aPorder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors()
	{
		return array(
				'datetimeI18NBehavior' => array(
					'class' => 'DateTimeI18NBehavior'
				),
				//'defaults'=>array(
				//	'class'=>'ext.decimali18nbehavior.DecimalI18NBehavior',
				//	//'format'=>'db',
				//),
		);
	}

	protected function beforeSave()
	{
		foreach($this->tableSchema->columns as $val) 
			$_listField[]=$val->name;

		if(parent::beforeSave())
		{
			if($this->isNewRecord) {
				if (in_array('created_date', $_listField)) {
					$this->created_date=time();
					$this->created_by= yii::app()->user->id;
				}
			} else {
				if (in_array('updated_date', $_listField)) {
					$this->updated_date=time();
					$this->updated_by= yii::app()->user->id;
				}
			}
			return true;
		} else
			return false;
	}



}