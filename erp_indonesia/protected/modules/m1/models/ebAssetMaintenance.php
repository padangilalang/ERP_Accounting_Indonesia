<?php

/**
 * This is the model class for table "eb_asset_maintenance".
 *
 * The followings are the available columns in table 'eb_asset_maintenance':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property integer $pattern_id
 * @property string $schedule_date
 * @property string $remark
 */
class ebAssetMaintenance extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EbAssetMaintenance the static model class
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
		return 'eb_asset_maintenance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id, input_date', 'required'),
				array('parent_id, pattern_id', 'numerical', 'integerOnly'=>true),
				array('remark', 'length', 'max'=>255),
				array('schedule_date', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, input_date, pattern_id, schedule_date, remark', 'safe', 'on'=>'search'),
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
				'parent_id' => 'Parent',
				'input_date' => 'Input Date',
				'pattern_id' => 'Pattern',
				'schedule_date' => 'Schedule Date',
				'remark' => 'Remark',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('input_date',$this->input_date,true);
		$criteria->compare('pattern_id',$this->pattern_id);
		$criteria->compare('schedule_date',$this->schedule_date,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

}