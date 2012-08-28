<?php

/**
 * This is the model class for table "g_leave".
 *
 * The followings are the available columns in table 'g_leave':
 * @property integer $id
 * @property integer $parent_id
 * @property string $n_cuti
 * @property string $d_cuti
 * @property string $c_hriskd
 * @property string $d_dari
 * @property string $d_sampai
 * @property integer $n_jmlhari
 * @property string $c_h_masuk
 * @property string $d_h_masuk
 * @property string $r_cuti
 * @property integer $n_cutiii
 * @property integer $c_masal
 * @property integer $c_pribadi
 * @property integer $n_sisacuti
 * @property string $c_ganti
 * @property string $c_ajukan
 * @property string $c_ketahui
 * @property string $c_setuju
 * @property string $d_ajukan
 * @property string $d_ketahui
 * @property string $d_setuju
 * @property string $userid
 * @property string $tglmodify
 * @property string $pt_kodept
 * @property string $pt_kodeproyek
 * @property string $t_keterangan
 * @property string $Id_OLD
 * @property integer $tahunke
 */
class gLeave extends BaseModel
{
	public $parent_name;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return gLeave the static model class
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
		return 'g_leave';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id, d_cuti,d_dari, d_sampai, n_jmlhari, r_cuti, d_h_masuk', 'required'),
				array('approved_id, parent_id, n_jmlhari, n_cutiii, c_masal, c_pribadi, n_sisacuti, tahunke', 'numerical', 'integerOnly'=>true),
				array('n_cuti', 'length', 'max'=>255),
				array('c_hriskd, c_h_masuk, c_ajukan, c_ketahui, c_setuju', 'length', 'max'=>10),
				array('r_cuti', 'length', 'max'=>75),
				array('userid, c_ganti', 'length', 'max'=>50),
				array('pt_kodept', 'length', 'max'=>2),
				array('pt_kodeproyek', 'length', 'max'=>3),
				array('t_keterangan', 'length', 'max'=>250),
				array('Id_OLD', 'length', 'max'=>5),
				array('d_cuti, d_dari, d_sampai, d_h_masuk, d_ajukan, d_ketahui, d_setuju, tglmodify', 'safe'),
				array('d_cuti, d_dari, d_sampai, d_h_masuk, d_ajukan, d_ketahui, d_setuju, tglmodify', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, n_cuti, d_cuti, c_hriskd, d_dari, d_sampai, n_jmlhari, c_h_masuk, d_h_masuk, r_cuti, n_cutiii, c_masal, c_pribadi, n_sisacuti, c_ganti, c_ajukan, c_ketahui, c_setuju, d_ajukan, d_ketahui, d_setuju, userid, tglmodify, pt_kodept, pt_kodeproyek, t_keterangan, Id_OLD, tahunke', 'safe', 'on'=>'search'),
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
				'approved' => array(self::BELONGS_TO, 'sParameter', array('approved_id'=>'code'),'condition'=>'type = \'cLeaveApproved\''),
				'person' => array(self::BELONGS_TO, 'gPerson', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_name' => 'Employee Name',
				'parent_id' => 'parent',
				'n_cuti' => 'N Cuti',
				'd_cuti' => 'Input Date',
				'c_hriskd' => 'HRID Code',
				'd_dari' => 'Start Date',
				'd_sampai' => 'End Date',
				'n_jmlhari' => 'Days',
				'c_h_masuk' => 'C H Masuk',
				'd_h_masuk' => 'In Date',
				'r_cuti' => 'Reason',
				'n_cutiii' => 'Started Leave',
				'c_masal' => 'Common Leaving',
				'c_pribadi' => 'Personal Leaving',
				'n_sisacuti' => 'Balance',
				'c_ganti' => 'Replacement Person',
				'c_ajukan' => 'C Ajukan',
				'c_ketahui' => 'C Ketahui',
				'c_setuju' => 'C Setuju',
				'd_ajukan' => 'D Ajukan',
				'd_ketahui' => 'D Ketahui',
				'd_setuju' => 'D Setuju',
				'userid' => 'Userid',
				'tglmodify' => 'Tglmodify',
				'pt_kodept' => 'Pt Kodept',
				'pt_kodeproyek' => 'Pt Kodeproyek',
				't_keterangan' => 'T Keterangan',
				'Id_OLD' => 'Id Old',
				'tahunke' => 'Tahunke',
				'approved_id' => 'State',
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
		$criteria->order='d_dari DESC';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>false,
		));
	}

	public static function getTopCreated() {

		$models=gPerson::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$_nama= (strlen($model->vc_psnama) >15) ? substr($model->vc_psnama,0,15)."..." : $model->vc_psnama;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('/m1/gLeave/view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated() {

		$models=gPerson::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$_nama= (strlen($model->vc_psnama) >15) ? substr($model->vc_psnama,0,15)."..." : $model->vc_psnama;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('/m1/gLeave/view','id'=>$model->id));
		}

		return $returnarray;
	}


}