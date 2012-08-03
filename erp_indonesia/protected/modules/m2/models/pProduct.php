<?php

/**
 * This is the model class for table "p_product".
 *
 * The followings are the available columns in table 'p_product':
 * @property integer $id
 * @property string $no_polisi
 * @property string $warna
 * @property string $no_bpkb
 * @property string $stnk_berlaku_sd
 * @property string $no_mesin
 * @property string $no_rangka
 * @property integer $created_date
 * @property integer $created_id
 * @property integer $updated_date
 * @property integer $updated_id
 */
class pProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return pProduct the static model class
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
		return 'p_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('no_polisi', 'required'),
				array('created_date, created_id, updated_date, updated_id', 'numerical', 'integerOnly'=>true),
				array('no_polisi, warna', 'length', 'max'=>15),
				array('no_bpkb, stnk_berlaku_sd, no_mesin, no_rangka', 'length', 'max'=>45),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, no_polisi, warna, no_bpkb, stnk_berlaku_sd, no_mesin, no_rangka, created_date, created_id, updated_date, updated_id', 'safe', 'on'=>'search'),
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
				'no_polisi' => 'No Polisi',
				'warna' => 'Warna',
				'no_bpkb' => 'No BPKB',
				'stnk_berlaku_sd' => 'STNK Berlaku sd',
				'no_mesin' => 'No Mesin',
				'no_rangka' => 'No Rangka',
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
		$criteria->compare('no_polisi',$this->no_polisi,true);
		$criteria->compare('warna',$this->warna,true);
		$criteria->compare('no_bpkb',$this->no_bpkb,true);
		$criteria->compare('stnk_berlaku_sd',$this->stnk_berlaku_sd,true);
		$criteria->compare('no_mesin',$this->no_mesin,true);
		$criteria->compare('no_rangka',$this->no_rangka,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('created_id',$this->created_id);
		$criteria->compare('updated_date',$this->updated_date);
		$criteria->compare('updated_id',$this->updated_id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public static function items()
	{
		$_items=array();

		$models=self::model()->findAll(array('limit'=>100));

		foreach($models as $model)
			$_items[$model->id]=$model->no_polisi;

		return $_items;
	}

}