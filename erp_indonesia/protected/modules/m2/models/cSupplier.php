<?php

/**
 * This is the model class for table "c_supplier".
 *
 * The followings are the available columns in table 'c_supplier':
 * @property integer $id
 * @property string $company_name
 * @property string $pic
 * @property string $address
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $city
 * @property string $pos_code
 * @property string $province
 * @property string $telephone
 * @property string $fax
 * @property string $email
 * @property integer $method_id
 * @property integer $bank_id
 * @property string $no_account
 * @property string $atas_nama
 * @property integer $status_id
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class cSupplier extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return cSupplier the static model class
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
		return 'c_supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				//array('method_id, bank_id, status_id, created_date, created_by, updated_date, updated_by', 'required'),
				array('method_id, bank_id, status_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly'=>true),
				array('company_name, telephone, fax, email', 'length', 'max'=>50),
				array('pic, no_account, atas_nama', 'length', 'max'=>40),
				array('address, city, province', 'length', 'max'=>100),
				array('address1', 'length', 'max'=>20),
				array('address2, address3', 'length', 'max'=>30),
				array('pos_code', 'length', 'max'=>7),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, company_name, pic, address, address1, address2, address3, city, pos_code, province, telephone, fax, email, method_id, bank_id, no_account, atas_nama, status_id, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'sort_po_created' => array(self::HAS_ONE, 'vPorder', 'supplier_id','order'=>'sort_po_created.created_date DESC'),
				'sort_po_updated' => array(self::HAS_ONE, 'vPorder', 'supplier_id','order'=>'sort_po_updated.updated_date DESC'),
				'status' => array(self::HAS_ONE, 'sParameter', array('code'=>'status_id'),'condition'=>'type = \'cStatusP\''),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'company_name' => 'Company Name',
				'pic' => 'PIC',
				'address' => 'Address',
				'address1' => 'Address1',
				'address2' => 'Address2',
				'address3' => 'Address3',
				'city' => 'City',
				'pos_code' => 'Pos Code',
				'province' => 'Province',
				'telephone' => 'Telephone',
				'fax' => 'Fax',
				'email' => 'Email',
				'method_id' => 'Method',
				'bank_id' => 'Bank',
				'no_account' => 'No Account',
				'atas_nama' => 'Atas Nama',
				'status_id' => 'Status',
				'created_date' => 'Created Date',
				'created_by' => 'Created',
				'updated_date' => 'Updated Date',
				'updated_by' => 'Updated',
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('address3',$this->address3,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('pos_code',$this->pos_code,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('method_id',$this->method_id);
		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('no_account',$this->no_account,true);
		$criteria->compare('atas_nama',$this->atas_nama,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_date',$this->updated_date);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public static function items()
	{
		$_items=array();
		$models=self::model()->findAll(array(

		));

		foreach($models as $model) {
			$_items[$model->id]=$model->company_name;
		}

		return $_items;
	}

	public static function getTopCreated() {

		$criteria=new CDbCriteria;
		$criteria->with=array('sort_po_created');
		$criteria->limit=10;
		$criteria->order = 'sort_po_created.created_date DESC';
		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->id, 'label' => $model->company_name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated() {

		$criteria=new CDbCriteria;
		$criteria->with=array('sort_po_updated');
		$criteria->limit=10;
		$criteria->order = 'sort_po_updated.updated_date DESC';
		$models=self::model()->findAll($criteria);

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->id, 'label' => $model->company_name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopRelated($id) {

		$_related = self::model()->findByPk((int)$id)->company_name;
		$_exp=explode(" ",$_related);


		$criteria=new CDbCriteria;

		if (isset($_exp[0]))
			$criteria->compare('name',$_exp[0],true,'OR');

		if (isset($_exp[1]))
			$criteria->compare('name',$_exp[1],true,'OR');
			
		$criteria->limit=10;
		$criteria->order='updated_date DESC';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}


}