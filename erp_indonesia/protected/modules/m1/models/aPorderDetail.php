<?php

/**
 * This is the model class for table "a_porder_detail".
 *
 * The followings are the available columns in table 'a_porder_detail':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $supplier_id
 * @property integer $budget_id
 * @property string $payment_date
 * @property string $description
 * @property string $user
 * @property integer $qty
 * @property string $uom
 * @property string $amount
 * @property string $need_date
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class aPorderDetail extends BaseModel
{
	public $sub_total;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return aPorderDetail the static model class
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
		return 'a_porder_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id, budget_id', 'required'),
				array('parent_id, supplier_id, budget_id, department_id, qty, created_date, updated_date, detail_payment_id', 'numerical', 'integerOnly'=>true),
				array('description', 'length', 'max'=>500),
				array('user', 'length', 'max'=>255),
				array('uom, amount, created_by, updated_by', 'length', 'max'=>15),
				array('need_date', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, supplier_id, budget_id, detail_payment_id, payment_date, description, user, qty, uom, amount, need_date, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'po' => array(self::BELONGS_TO, 'aPorder', 'parent_id'),
				'budget' => array(self::BELONGS_TO, 'aBudget', 'budget_id'),
				'supplier' => array(self::BELONGS_TO, 'BSupplier', 'supplier_id'),
				'department' => array(self::BELONGS_TO, 'aOrganization', 'department_id'),
				'payment' => array(self::BELONGS_TO, 'sParameter', array('detail_payment_id'=>'code'),'condition'=>'type = "cPayment"'),
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
				'supplier_id' => 'Supplier',
				'budget_id' => 'Budget',
				'department_id' => 'Department',
				'payment_date' => 'Payment Date',
				'description' => 'Description',
				'user' => 'User',
				'qty' => 'Qty',
				'uom' => 'Uom',
				'amount' => 'Amount',
				'need_date' => 'Need Date',
				'detail_payment_id' => 'Detail Payment Status',
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
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);
		$criteria->order='id';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>30
				)
		));
	}

	public function amountf() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->amount);

		return $_format;
	}

	public function totalf() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->qty*$this->amount);

		return $_format;
	}

}