<?php

/**
 * This is the model class for table "a_budget_department".
 *
 * The followings are the available columns in table 'a_budget_department':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property integer $periode_date
 * @property string $no_ref
 * @property integer $department_id
 * @property string $tdebt
 * @property string $tcredit
 * @property string $balance
 * @property string $remark
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class aBudgetDepartment extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return aBudgetDepartment the static model class
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
		return 'a_budget_department';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				//array('parent_id, periode_date, no_ref, department_id, tdebt, tcredit, balance', 'required'),
				array('parent_id, periode_date, department_id, created_date, updated_date', 'numerical', 'integerOnly'=>true),
				array('no_ref, remark', 'length', 'max'=>100),
				array('tdebt, tcredit, balance, created_by, updated_by', 'length', 'max'=>15),
				array('input_date', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, input_date, periode_date, no_ref, department_id, tdebt, tcredit, balance, remark, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'periode_date' => 'Periode Date',
				'no_ref' => 'No Ref',
				'department_id' => 'Department',
				'tdebt' => 'Tdebt',
				'tcredit' => 'Tcredit',
				'balance' => 'Balance',
				'remark' => 'Remark',
				'created_date' => 'Created Date',
				'created_by' => 'Created By',
				'updated_date' => 'Updated Date',
				'updated_by' => 'Updated By',
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
		$criteria->compare('periode_date',$this->periode_date);
		$criteria->compare('no_ref',$this->no_ref,true);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('tdebt',$this->tdebt,true);
		$criteria->compare('tcredit',$this->tcredit,true);
		$criteria->compare('balance',$this->balance,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function getSaldo($id,$did)
	{
		return $this->countBySql('select balance from a_budget_department where parent_id = '. $id .' AND department_id = '.$did.' order by id desc limit 1');
	}

	public function balancef() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->balance);

		return $_format;
	}

}