<?php

/**
 * This is the model class for table "v_porder_detail".
 *
 * The followings are the available columns in table 'v_porder_detail':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $item_id
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
class vPorderDetail extends BaseModel
{
	public $sub_total;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return vPorderDetail the static model class
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
		return 'v_porder_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id, item_id', 'required'),
				array('parent_id, item_id, qty, created_date, updated_date', 'numerical', 'integerOnly'=>true),
				array('description', 'length', 'max'=>500),
				array('user', 'length', 'max'=>255),
				array('uom, amount, created_by, updated_by', 'length', 'max'=>15),
				array('need_date', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, item_id, payment_date, description, user, qty, uom, amount, need_date, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'po' => array(self::BELONGS_TO, 'vPorder', 'parent_id'),
				'item_inventory' => array(self::BELONGS_TO, 'xProduct', 'item_id'),
				'item_general' => array(self::BELONGS_TO, 'tAccount', 'item_id'),
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
				'item_id' => 'Item',
				'description' => 'Description',
				'qty' => 'Qty',
				'uom' => 'Uom',
				'amount' => 'Amount',
				'need_date' => 'Need Date',
				'created_date' => 'Created Date',
				'created_by' => 'Created By',
				'updated_date' => 'Updated Date',
				'updated_by' => 'Updated By',
		);
	}

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

	public function total() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->qty*$this->amount);

		return $_format;
	}

}