<?php

/**
 * This is the model class for table "g_education".
 *
 * The followings are the available columns in table 'g_education':
 * @property integer $id
 * @property integer $parent_id
 * @property string $c_hriskd
 * @property string $c_fmjenjang
 * @property string $vc_fmnama
 * @property string $c_fmkota
 * @property string $c_fmjurusan
 * @property string $n_fmlulus
 * @property string $c_rfnegara
 * @property string $c_institusi
 * @property string $userid
 * @property string $tglmodify
 * @property string $pt_kodept
 * @property string $py_kodeproyek
 * @property string $pf_ipk
 * @property string $t_jenis
 */
class gPersonEducation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return gEducation the static model class
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
		return 'g_person_education';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id', 'numerical', 'integerOnly'=>true),
				array('c_hriskd, c_fmjenjang, c_fmkota, c_fmjurusan, c_rfnegara, t_jenis', 'length', 'max'=>10),
				array('vc_fmnama', 'length', 'max'=>50),
				array('n_fmlulus', 'length', 'max'=>4),
				array('c_institusi', 'length', 'max'=>255),
				array('userid', 'length', 'max'=>20),
				array('pt_kodept', 'length', 'max'=>2),
				array('py_kodeproyek', 'length', 'max'=>3),
				array('pf_ipk', 'length', 'max'=>5),
				array('tglmodify', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, c_hriskd, c_fmjenjang, vc_fmnama, c_fmkota, c_fmjurusan, n_fmlulus, c_rfnegara, c_institusi, userid, tglmodify, pt_kodept, py_kodeproyek, pf_ipk, t_jenis', 'safe', 'on'=>'search'),
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
				'c_hriskd' => 'HRIS Code',
				'c_fmjenjang' => 'Program',
				'vc_fmnama' => 'Name',
				'c_fmkota' => 'City',
				'c_fmjurusan' => 'Speciality',
				'n_fmlulus' => 'Graduation Year',
				'c_rfnegara' => 'Country',
				'c_institusi' => 'Institute',
				'userid' => 'Userid',
				'tglmodify' => 'Tglmodify',
				'pt_kodept' => 'Pt Kodept',
				'py_kodeproyek' => 'Py Kodeproyek',
				'pf_ipk' => 'Pf Ipk',
				't_jenis' => 'T Jenis',
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

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}