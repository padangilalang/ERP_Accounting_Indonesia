<?php

class sParameter extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_parameter';
	}

	public function rules()
	{
		return array(
				array('name, code, type', 'required'),
				array('code', 'numerical', 'integerOnly'=>true),
				array('name, type', 'length', 'max'=>128),
				array('name, code, type', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(

		);
	}

	public function attributeLabels()
	{
		return array(
				'name' => 'Name',
				'code' => 'Code',
				'type' => 'Type',
		);
	}

	public function lastItem($type) {
		$_item=self::model()->find(array(
				'order'=>'code DESC',
				'condition'=>'type = :type ',
				'params'=>array(':type'=>$type),
		));
		if (isset($_item)) {
			$_code=$_item->code+1;
		} else
			$_code=false;

		return $_code;
	}

	public function search($type=null)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code);
		$criteria->compare('type',$type);
		$criteria->order='type,code';

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>30,
				),
		));
	}

	public function searchP()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code);
		$criteria->compare('type','cPeriode');

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}

	private static $_items=array();

	public static function items($type,$all=0)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type,$all);
		return self::$_items[$type];
	}

	public static function item($type,$code)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
	}

	private static function loadItems($type,$all=null)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
				'condition'=>'type=:type',
				'params'=>array(':type'=>$type),
		));

		if ($all !=null)
			self::$_items[$type][0]='*inherited*';

		foreach($models as $model)
			self::$_items[$type][$model->code]=$model->name;
	}

	public function ItemsOther($type)
	{
		$_items=array();
		$models=self::model()->findAll(array(
				'condition'=>'type=:type',
				'params'=>array(':type'=>$type),
		));

		foreach($models as $model)
			$_items[$model->name]=$model->name;

		return $_items;
	}

	private static $_items3=array();
	public static function items3($type)
	{
		if(!isset(self::$_items3[$type]))
			self::loadItems3($type);
		return self::$_items3[$type];
	}

	private static function loadItems3($type)
	{
		self::$_items3[$type]=array();
		$models=self::model()->findAllBySql('select distinct type from s_parameter');
		self::$_items3[$type]['']='(ALL)';
		foreach($models as $model)
			self::$_items3[$type][$model->type]=$model->type;
	}

	private static $_items2=array();
	public static function items2($type)
	{
		if(!isset(self::$_items2[$type]))
			self::loadItems2($type);
		return self::$_items2[$type];
	}

	private static function loadItems2($type)
	{
		self::$_items2[$type]=array();
		$models=self::model()->findAllBySql('select distinct type from s_parameter');
		//self::$_items3[$type]['']='(ALL)';
		foreach($models as $model)
			self::$_items2[$type][$model->type]=$model->type;
	}

	public static function BulanTahun($val)
	{
		$_bulan= substr($val,4,2);
		$_tahun= substr($val,0,4);


		if($_bulan == "01")
			$_bulan = "Januari";
		else if($_bulan == "02")
			$_bulan = "Februari";
		else if($_bulan == "03")
			$_bulan = "Maret";
		else if($_bulan == "04")
			$_bulan = "April";
		else if($_bulan == "05")
			$_bulan = "Mei";
		else if($_bulan == "06")
			$_bulan = "Juni";
		else if($_bulan == "07")
			$_bulan = "Juli";
		else if($_bulan == "08")
			$_bulan = "Agustus";
		else if($_bulan == "09")
			$_bulan = "September";
		else if($_bulan == "10")
			$_bulan = "Oktober";
		else if($_bulan == "11")
			$_bulan = "November";
		else if($_bulan == "12")
			$_bulan = "Desember";

		$val = $_bulan." ".$_tahun;

		return $val;


	}


	public static function cBeginDateBefore($val)
	{
		$_bulan= substr($val,4,2);
		$_tahun= substr($val,0,4);


		if($_bulan == "01") {
			$_bulan1 = "12";
			$_tahun= ((int)$_tahun)-1;
		}
		else if($_bulan == "02")
			$_bulan1 = "01";
		else if($_bulan == "03")
			$_bulan1 = "02";
		else if($_bulan == "04")
			$_bulan1 = "03";
		else if($_bulan == "05")
			$_bulan1 = "04";
		else if($_bulan == "06")
			$_bulan1 = "05";
		else if($_bulan == "07")
			$_bulan1 = "06";
		else if($_bulan == "08")
			$_bulan1 = "07";
		else if($_bulan == "09")
			$_bulan1 = "08";
		else if($_bulan == "10")
			$_bulan1= "09";
		else if($_bulan == "11")
			$_bulan1 = "10";
		else if($_bulan == "12")
			$_bulan1 = "11";

		$val = $_tahun.$_bulan1;

		return $val;


	}

	public static function cBeginDateAfter($val)
	{
		$_bulan= substr($val,4,2);
		$_tahun= substr($val,0,4);


		if($_bulan == "01")
			$_bulan1 = "02";
		else if($_bulan == "02")
			$_bulan1 = "03";
		else if($_bulan == "03")
			$_bulan1 = "04";
		else if($_bulan == "04")
			$_bulan1 = "05";
		else if($_bulan == "05")
			$_bulan1 = "06";
		else if($_bulan == "06")
			$_bulan1 = "07";
		else if($_bulan == "07")
			$_bulan1 = "08";
		else if($_bulan == "08")
			$_bulan1 = "09";
		else if($_bulan == "09")
			$_bulan1 = "10";
		else if($_bulan == "10")
			$_bulan1= "11";
		else if($_bulan == "11")
			$_bulan1 = "12";
		else if($_bulan == "12") {
			$_bulan1 = "01";
			$_tahun= ((int)$_tahun)+1;
		}

		$val = $_tahun.$_bulan1;

		return $val;


	}

}