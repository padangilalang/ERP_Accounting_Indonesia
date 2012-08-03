<?php

/**
 * This is the model class for table "g_family".
 *
 * The followings are the available columns in table 'g_family':
 * @property integer $id
 * @property integer $parent_id
 * @property string $c_hriskd
 * @property string $vc_nmfm
 * @property string $c_hubfm
 * @property string $vc_hubfm
 * @property string $d_tgllhr
 * @property integer $b_jkel
 * @property string $c_templhr
 * @property integer $b_aktif
 * @property string $vc_ket
 * @property string $userid
 * @property string $tglmodify
 * @property string $pt_kodept
 * @property string $py_kodeproyek
 * @property integer $f_cover
 */
class gFamily extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return gFamily the static model class
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
		return 'g_family';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id, b_jkel, b_aktif, f_cover', 'numerical', 'integerOnly'=>true),
				array('c_hriskd, c_hubfm, c_templhr', 'length', 'max'=>10),
				array('vc_nmfm, vc_hubfm', 'length', 'max'=>50),
				array('vc_ket', 'length', 'max'=>200),
				array('userid', 'length', 'max'=>20),
				array('pt_kodept', 'length', 'max'=>2),
				array('py_kodeproyek', 'length', 'max'=>3),
				array('d_tgllhr, tglmodify', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, c_hriskd, vc_nmfm, c_hubfm, vc_hubfm, d_tgllhr, b_jkel, c_templhr, b_aktif, vc_ket, userid, tglmodify, pt_kodept, py_kodeproyek, f_cover', 'safe', 'on'=>'search'),
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
				'relation' => array(self::BELONGS_TO, 'sParameter', array('c_hubfm'=>'code'),'condition'=>'type = \'HK\''),
				'birthplace' => array(self::BELONGS_TO, 'sParameter', array('c_templhr'=>'code'),'condition'=>'type = \'TL\''),
				'sex' => array(self::BELONGS_TO, 'sParameter', array('b_jkel'=>'code'),'condition'=>'type = \'ckelamin\''),
				'status' => array(self::BELONGS_TO, 'sParameter', array('b_aktif'=>'code'),'condition'=>'type = \'cStatus\''),
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
				'c_hriskd' => 'HRIS Code',
				'vc_nmfm' => 'Name',
				'c_hubfm' => 'Relation',
				'vc_hubfm' => 'Relation Name',
				'd_tgllhr' => 'Birthdate',
				'b_jkel' => 'Sex',
				'c_templhr' => 'Birthplace',
				'b_aktif' => 'Status',
				'vc_ket' => 'Remark',
				'userid' => 'Userid',
				'tglmodify' => 'Tglmodify',
				'pt_kodept' => 'Pt Kodept',
				'py_kodeproyek' => 'Py Kodeproyek',
				'f_cover' => 'F Cover',
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
		$criteria->compare('c_hubfm',$this->c_hubfm,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>false,
		));
	}

	public function behaviors()
	{
		return array(
				'datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'),
				'defaults'=>array(
						'class'=>'ext.decimali18nbehavior.DecimalI18NBehavior',
						//'format'=>'db',
				),
				//'ActiveRecordLogableBehavior'=>array('class'=>'ext.ActiveRecordLogableBehavior'),
		);
	}


}