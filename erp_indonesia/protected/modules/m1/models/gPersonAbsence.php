<?php

/**
 * This is the model class for table "c_personalia_absence".
 *
 * The followings are the available columns in table 'c_personalia_absence':
 * @property string $id
 * @property string $parent_id
 * @property string $cdate
 * @property integer $realpattern_id
 * @property integer $daystatus1_id
 * @property string $in
 * @property string $out
 */
class gPersonAbsence extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return cPersonaliaAbsence the static model class
	 */
	public $lateIn;
	public $EarlyOut;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'g_person_absence';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('cdate', 'required'),
				array('realpattern_id, daystatus1_id,daystatus2_id,daystatus3_id', 'numerical', 'integerOnly'=>true),
				array('parent_id', 'length', 'max'=>11),
				array('remark', 'length', 'max'=>150),
				array('cdate, in, out', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, cdate, realpattern_id, daystatus1_id, in, out', 'safe', 'on'=>'search'),
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
				'timeBlock'=>array(self::BELONGS_TO, 'GParamTimeblock', 'realpattern_id'),
				'persona'=>array(self::BELONGS_TO, 'gPerson', 'parent_id'),
				'dayCategory'=>array(self::BELONGS_TO, 'CDayCategory', 'daystatus1_id'),
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
				'cdate' => 'Date',
				'realpattern_id' => 'Real Pattern',
				'daystatus1_id' => 'Day Status 1',
				'daystatus2_id' => 'Day Status 2',
				'daystatus3_id' => 'Day Status 3',
				'in' => 'In',
				'out' => 'Out',
				'remark' => 'Remark',
				'overtime_factor' => 'Overtime Factor',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id,$month)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		//write your code here
		//$date = strtotime("+1 day", $date);

		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);
		$criteria->addBetweenCondition('cdate',date("Y-m-d",strtotime(date("Y-m",strtotime($month." month"))."-01")),
				date("Y-m-d",strtotime("-1 day",strtotime(date("Y-m",strtotime($month+1 ." month"))."-01"))));
		//$criteria->compare('cdate',$this->cdate,true);
		//$criteria->compare('realpattern_id',$this->realpattern_id);
		//$criteria->compare('daystatus1_id',$this->daystatus1_id);
		//$criteria->compare('in',$this->in,true);
		//$criteria->compare('out',$this->out,true);
		$criteria->order='cdate';
		$criteria->with='timeBlock';
		$criteria->select='CASE WHEN TIME(timeBlock.in) < TIME(t.in) AND t.daystatus1_id <> 4 THEN "Late In" ELSE "" END as lateIn,
		CASE WHEN TIME(timeBlock.out) > TIME(t.out) AND t.daystatus1_id <> 4 THEN "Early Out" ELSE "" END as EarlyOut, *';

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>31,
				),
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function filterOvertime($id,$month)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		//write your code here
		//$date = strtotime("+1 day", $date);

		$criteria=new CDbCriteria;

		$criteria->condition='overtime_factor is not null';
		$criteria->compare('parent_id',$id);
		$criteria->addBetweenCondition('cdate',date("Y-m-d",strtotime(date("Y-m",strtotime($month." month"))."-01")),
				date("Y-m-d",strtotime("-1 day",strtotime(date("Y-m",strtotime($month+1 ." month"))."-01"))));
		//$criteria->compare('cdate',$this->cdate,true);
		//$criteria->compare('realpattern_id',$this->realpattern_id);
		//$criteria->compare('daystatus1_id',$this->daystatus1_id);
		//$criteria->compare('in',$this->in,true);
		//$criteria->compare('out',$this->out,true);
		$criteria->order='cdate';

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>31,
				),
		));
	}

	public function lateIn()
	{
		if (strtotime($this->in) < strtotime($this->in))
			return "Late In";
	}

}