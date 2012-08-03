<?php

/**
 * This is the model class for table "v_budget".
 *
 * The followings are the available columns in table 'v_budget':
 * @property integer $id
 * @property integer $year
 * @property string $name
 * @property string $ttl_amount
 */
class vBudget extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VBudget the static model class
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
		return 'v_budget';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('id, costcenter_id, year', 'numerical', 'integerOnly'=>true),
				array('name, code', 'length', 'max'=>50),
				array('ttl_amount, actual_ytd', 'length', 'max'=>38),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, year, name, ttl_amount', 'safe', 'on'=>'search'),
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
				'year' => 'Year',
				'costcenter_id' => 'Cost Center',
				'code' => 'Code',
				'name' => 'Name',
				'ttl_amount' => 'TTL Amount',
				'actual_ytd' => 'Actual YTD',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('costcenter_id',$id);
		$criteria->compare('id',$this->id);
		$criteria->compare('year',$this->year);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ttl_amount',$this->ttl_amount,true);
		$criteria->compare('actual_ytd',$this->actual_ytd,true);

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>20,
				),
		));
	}

	/////////////////////////////////////////////// dipake di aorgkoordlokal/view - CGridView
	public function search1($id)
	{
		$rawData=Yii::app()->db->createCommand('SELECT a.id, a.costcenter_id, a.year, Sum(a.ttl_amount) AS tttl_amount, Sum(a.actual_ytd) AS ttl_actual_ytd, Sum(a.ttl_amount) - Sum(a.actual_ytd) as balance, Sum(a.actual_ytd)/Sum(a.ttl_amount)*100 as absortion FROM v_budget a GROUP BY a.costcenter_id, a.year HAVING a.costcenter_id = '.$id )->queryAll() ;

		return new CArrayDataProvider($rawData, array(
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
	}


}