<?php

/**
 * This is the model class for table "v_porder_ext".
 *
 * The followings are the available columns in table 'v_porder_ext':
 * @property integer $id
 * @property string $af_date
 * @property integer $created_date
 * @property integer $created_id
 * @property integer $updated_date
 * @property integer $updated_id
 */
class vPorderExt extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return vPorderExt the static model class
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
		return 'v_porderext';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_date, created_id, updated_date, updated_id', 'numerical', 'integerOnly'=>true),
			array('af_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, af_date, created_date, created_id, updated_date, updated_id', 'safe', 'on'=>'search'),
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
			'af_date' => 'Af Date',
			'created_date' => 'Created Date',
			'created_id' => 'Created',
			'updated_date' => 'Updated Date',
			'updated_id' => 'Updated',
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
		$criteria->compare('af_date',$this->af_date,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('created_id',$this->created_id);
		$criteria->compare('updated_date',$this->updated_date);
		$criteria->compare('updated_id',$this->updated_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function behaviors()
	{
		return array(
				'datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'),
				//'defaults'=>array(
				//	'class'=>'ext.decimali18nbehavior.DecimalI18NBehavior',
				//	//'format'=>'db',
				//),
		);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord) {
				$this->created_date=time();
				$this->created_id= yii::app()->user->id;
			} else {
				$this->updated_date=time();
				$this->updated_id= yii::app()->user->id;
			}
			return true;
		}
		else
			return false;
	}
	
}