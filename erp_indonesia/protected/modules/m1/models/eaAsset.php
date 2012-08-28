<?php

/**
 * This is the model class for table "ea_asset".
 *
 * The followings are the available columns in table 'ea_asset':
 * @property integer $id
 * @property integer $accesslevel_id
 * @property string $input_date
 * @property integer $periode_date
 * @property integer $category_id
 * @property string $item
 * @property string $brand
 * @property string $type
 * @property string $serial_number
 * @property string $inventory_code
 * @property string $bpb_number
 * @property integer $supplier_id
 * @property string $po_number
 * @property double $price
 * @property string $other1
 * @property string $other2
 * @property string $other3
 * @property string $other4
 * @property string $warranty
 * @property string $insurance
 * @property string $remark
 * @property string $photo_path
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class eaAsset extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EaAsset the static model class
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
		return 'ea_asset';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('accesslevel_id, input_date, periode_date, category_id, supplier_id', 'required'),
				array('accesslevel_id, periode_date, category_id, supplier_id, created_date, updated_date', 'numerical', 'integerOnly'=>true),
				array('price', 'numerical'),
				array('item, brand, type, warranty, insurance, created_by, updated_by', 'length', 'max'=>50),
				array('serial_number', 'length', 'max'=>100),
				array('inventory_code, bpb_number, po_number, other1, other2, other3, other4, remark', 'length', 'max'=>255),
				array('photo_path', 'length', 'max'=>150),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, accesslevel_id, input_date, periode_date, category_id, item, brand, type, serial_number, inventory_code, bpb_number, supplier_id, po_number, price, other1, other2, other3, other4, warranty, insurance, remark, photo_path, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'accesslevel_id' => 'Accesslevel',
				'input_date' => 'Input Date',
				'periode_date' => 'Periode Date',
				'category_id' => 'Category',
				'item' => 'Item',
				'brand' => 'Brand',
				'type' => 'Type',
				'serial_number' => 'Serial Number',
				'inventory_code' => 'Inventory Code',
				'bpb_number' => 'Bpb Number',
				'supplier_id' => 'Supplier',
				'po_number' => 'Po Number',
				'price' => 'Price',
				'other1' => 'Other1',
				'other2' => 'Other2',
				'other3' => 'Other3',
				'other4' => 'Other4',
				'warranty' => 'Warranty',
				'insurance' => 'Insurance',
				'remark' => 'Remark',
				'photo_path' => 'Photo Path',
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
		$criteria->compare('accesslevel_id',$this->accesslevel_id);
		$criteria->compare('input_date',$this->input_date,true);
		$criteria->compare('periode_date',$this->periode_date);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('serial_number',$this->serial_number,true);
		$criteria->compare('inventory_code',$this->inventory_code,true);
		$criteria->compare('bpb_number',$this->bpb_number,true);
		$criteria->compare('supplier_id',$this->supplier_id);
		$criteria->compare('po_number',$this->po_number,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('other1',$this->other1,true);
		$criteria->compare('other2',$this->other2,true);
		$criteria->compare('other3',$this->other3,true);
		$criteria->compare('other4',$this->other4,true);
		$criteria->compare('warranty',$this->warranty,true);
		$criteria->compare('insurance',$this->insurance,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('photo_path',$this->photo_path,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->user_ref, 'label' => $model->user_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopUpdated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->user_ref, 'label' => $model->user_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopRelated($name) {

		//$_related = self::model()->find((int)$id)->account_name;
		$_exp=explode(" ",$name);


		$criteria=new CDbCriteria;
		//$criteria->compare('account_name',$_related,true,'OR');

		if (isset($_exp[0]))
			$criteria->compare('user_ref',$_exp[0],true,'OR');

		if (isset($_exp[1]))
			$criteria->compare('user_ref',$_exp[1],true,'OR');
			
		$criteria->limit=10;
		$criteria->order='updated_date DESC';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->account_no . " ".$model->account_name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

}