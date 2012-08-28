<?php

/**
 * This is the model class for table "g_karir".
 *
 * The followings are the available columns in table 'g_karir':
 * @property integer $id
 * @property integer $parent_id
 * @property string $i_idkarir
 * @property string $c_hriskd
 * @property string $d_awalkr
 * @property string $d_akhirkr
 * @property string $c_unitkr
 * @property string $c_direkkr
 * @property string $c_golkr
 * @property string $c_pangkatkr
 * @property string $c_jabatankr
 * @property string $c_nmjabatankr
 * @property string $c_departkr
 * @property string $c_stskr
 * @property string $c_perushkr
 * @property string $vc_lokasikr
 * @property string $vc_alasankr
 * @property string $c_alhriskd
 * @property string $c_lokasikr
 * @property string $c_alasankr
 * @property string $userid
 * @property string $tglmodify
 * @property string $pt_kodept
 * @property string $py_kodeproyek
 * @property integer $t_status
 * @property string $t_stat
 */
class gPersonKarir extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return gKarir the static model class
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
		return 'g_person_karir';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id, t_status', 'numerical', 'integerOnly'=>true),
				array('i_idkarir', 'length', 'max'=>255),
				array('c_hriskd, c_unitkr, c_direkkr, c_golkr, c_pangkatkr, c_jabatankr, c_nmjabatankr, c_departkr, c_stskr, c_perushkr, c_alhriskd, c_lokasikr, c_alasankr', 'length', 'max'=>10),
				array('vc_lokasikr', 'length', 'max'=>50),
				array('vc_alasankr', 'length', 'max'=>100),
				array('userid', 'length', 'max'=>20),
				array('pt_kodept', 'length', 'max'=>2),
				array('py_kodeproyek', 'length', 'max'=>3),
				array('t_stat', 'length', 'max'=>1),
				array('d_awalkr, d_akhirkr, tglmodify', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, i_idkarir, c_hriskd, d_awalkr, d_akhirkr, c_unitkr, c_direkkr, c_golkr, c_pangkatkr, c_jabatankr, c_nmjabatankr, c_departkr, c_stskr, c_perushkr, vc_lokasikr, vc_alasankr, c_alhriskd, c_lokasikr, c_alasankr, userid, tglmodify, pt_kodept, py_kodeproyek, t_status, t_stat', 'safe', 'on'=>'search'),
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
				'unit' => array(self::BELONGS_TO, 'aOrganization', 'c_unitkr'),
				'golongan' => array(self::BELONGS_TO, 'sParameter', array('c_golkr'=>'code'),'condition'=>'type = \'GO\''),
				'level' => array(self::BELONGS_TO, 'sParameter', array('c_pangkatkr'=>'code'),'condition'=>'type = \'PK\''),
				'position' => array(self::BELONGS_TO, 'sParameter', array('c_nmjabatankr'=>'code'),'condition'=>'type = \'NJ\''),
				'status' => array(self::BELONGS_TO, 'sParameter', array('c_stskr'=>'code'),'condition'=>'type = \'ST\''),
				'department' => array(self::BELONGS_TO, 'sParameter', array('c_departkr'=>'code'),'condition'=>'type = \'DP\''),
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
				'i_idkarir' => 'I Idkarir',
				'c_hriskd' => 'HRIS Code',
				'd_awalkr' => 'Start Date',
				'd_akhirkr' => 'End Date',
				'c_unitkr' => 'Unit',
				'c_direkkr' => 'Directorate',
				'c_golkr' => 'Golongan',
				'c_pangkatkr' => 'Level',
				'c_jabatankr' => 'Position',
				'c_nmjabatankr' => 'Position Name',
				'c_departkr' => 'Department',
				'c_stskr' => 'Status',
				'c_perushkr' => 'Company',
				'vc_lokasikr' => 'Comp. Location',
				'vc_alasankr' => 'Reason',
				'c_alhriskd' => 'C Alhriskd',
				'c_lokasikr' => 'C Lokasikr',
				'c_alasankr' => 'C Alasankr',
				'userid' => 'Userid',
				'tglmodify' => 'Tglmodify',
				'pt_kodept' => 'Pt Kodept',
				'py_kodeproyek' => 'Py Kodeproyek',
				't_status' => 'T Status',
				't_stat' => 'T Stat',
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
		$criteria->order='d_awalkr DESC';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>false,
		));
	}

}