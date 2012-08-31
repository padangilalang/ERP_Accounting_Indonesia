<?php

/**
 * This is the model class for table "g_person".
 *
 * The followings are the available columns in table 'g_person':
 * @property integer $id
 * @property string $c_hriskd
 * @property string $c_proyek
 * @property string $c_pt
 * @property string $c_direktorat
 * @property string $c_pskode
 * @property string $vc_psnama
 * @property string $vc_pstemlhr
 * @property string $d_pstgllhr
 * @property integer $b_psjkel
 * @property string $c_rfagama
 * @property string $c_psstskw
 * @property string $c_stspjk
 * @property string $c_rfkwarga
 * @property string $t_domalamat
 * @property string $vc_domkec
 * @property string $c_domcity
 * @property string $c_dompos
 * @property string $c_psktp
 * @property string $d_psktp
 * @property string $t_psalamat
 * @property string $vc_pskec
 * @property string $c_rfcity
 * @property string $c_pskdpos
 * @property string $vc_psemail
 * @property string $vc_psemail2
 * @property string $c_rfdarah
 * @property string $vc_psnotelp
 * @property string $vc_psnohp
 * @property string $vc_psnohp2
 * @property string $vc_pshobby
 * @property string $c_psaktif
 * @property string $c_kdaktif
 * @property string $t_psaktifket
 * @property string $d_joinunit
 * @property string $d_joingrp
 * @property integer $b_sambung
 * @property string $c_pathfoto
 * @property string $userid
 * @property string $tglmodify
 * @property string $pt_kodept
 * @property string $py_kodeproyek
 * @property integer $t_status
 * @property integer $t_status2
 */
class gPerson extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return gPerson the static model class
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
		return 'g_person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('b_psjkel, b_sambung, t_status, t_status2', 'numerical', 'integerOnly'=>true),
				array('c_hriskd, c_pskode, c_rfagama, c_psstskw, c_stspjk, c_rfkwarga, c_domcity, c_rfcity, c_rfdarah, c_psaktif, c_kdaktif', 'length', 'max'=>10),
				array('c_proyek, py_kodeproyek', 'length', 'max'=>3),
				array('c_pt, c_direktorat, pt_kodept', 'length', 'max'=>2),
				array('vc_psnama, vc_psemail, vc_psemail2, vc_pshobby', 'length', 'max'=>100),
				array('vc_pstemlhr, userid', 'length', 'max'=>20),
				array('t_domalamat, t_psalamat, c_pathfoto', 'length', 'max'=>255),
				array('vc_domkec, vc_pskec, vc_psnotelp, vc_psnohp, vc_psnohp2', 'length', 'max'=>50),
				array('c_dompos, c_pskdpos', 'length', 'max'=>5),
				array('c_psktp', 'length', 'max'=>25),
				array('d_pstgllhr, d_psktp, t_psaktifket, d_joinunit, d_joingrp, tglmodify', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, c_hriskd, c_proyek, c_pt, c_direktorat, c_pskode, vc_psnama, vc_pstemlhr, d_pstgllhr, b_psjkel, c_rfagama, c_psstskw, c_stspjk, c_rfkwarga, t_domalamat, vc_domkec, c_domcity, c_dompos, c_psktp, d_psktp, t_psalamat, vc_pskec, c_rfcity, c_pskdpos, vc_psemail, vc_psemail2, c_rfdarah, vc_psnotelp, vc_psnohp, vc_psnohp2, vc_pshobby, c_psaktif, c_kdaktif, t_psaktifket, d_joinunit, d_joingrp, b_sambung, c_pathfoto, userid, tglmodify, pt_kodept, py_kodeproyek, t_status, t_status2', 'safe', 'on'=>'search'),
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
				'religion' => array(self::BELONGS_TO, 'sParameter', array('c_rfagama'=>'code'),'condition'=>'type = \'AG\''),
				'birthplace' => array(self::BELONGS_TO, 'sParameter', array('vc_pstemlhr'=>'code'),'condition'=>'type = \'TL\''),
				'sf' => array(self::BELONGS_TO, 'sParameter', array('c_stspjk'=>'code'),'condition'=>'type = \'SF\''),
				'maritalstatus' => array(self::BELONGS_TO, 'sParameter', array('c_psstskw'=>'code'),'condition'=>'type = \'SKW\''),
				'sex' => array(self::BELONGS_TO, 'sParameter', array('b_psjkel'=>'code'),'condition'=>'type = \'cKelamin\''),
				//gPersonKarir
				'position' => array(self::HAS_ONE, 'gPersonKarir', 'parent_id','order'=>'d_awalkr DESC'),
				//gLeave
				'leaveAll' => array(self::HAS_MANY, 'gLeave', 'parent_id','order'=>'leaveAll.d_dari'),
				'leave' => array(self::HAS_ONE, 'gLeave', 'parent_id','order'=>'d_dari DESC'),
				'leaveBalance' => array(self::HAS_ONE, 'gLeave', 'parent_id','condition'=>'n_sisacuti is not null','order'=>'d_dari DESC'),
				'leaveInitial' => array(self::HAS_ONE, 'gLeave', 'parent_id','condition'=>'approved_id = 9','order'=>'d_dari DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'c_hriskd' => 'HRIS code',
				'c_proyek' => 'Project',
				'c_pt' => 'Company',
				'c_direktorat' => 'Directorate',
				'c_pskode' => 'PS Code',
				'vc_psnama' => 'Name',
				'vc_pstemlhr' => 'Birth Place',
				'd_pstgllhr' => 'Birth Date',
				'b_psjkel' => 'Sex',
				'c_rfagama' => 'Religion',
				'c_psstskw' => 'C Psstskw',
				'c_stspjk' => 'C Stspjk',
				'c_rfkwarga' => 'C Rfkwarga',
				't_domalamat' => 'Address',
				'vc_domkec' => 'Kecamatan',
				'c_domcity' => 'City',
				'c_dompos' => 'Post Code',
				'c_psktp' => 'KTP',
				'd_psktp' => 'D Psktp',
				't_psalamat' => 'Address',
				'vc_pskec' => 'Kecamatan',
				'c_rfcity' => 'City',
				'c_pskdpos' => 'Post Code',
				'vc_psemail' => 'Email',
				'vc_psemail2' => 'Email2',
				'c_rfdarah' => 'Blood',
				'vc_psnotelp' => 'Phone',
				'vc_psnohp' => 'HP',
				'vc_psnohp2' => 'HP2',
				'vc_pshobby' => 'Hobby',
				'c_psaktif' => 'C Psaktif',
				'c_kdaktif' => 'C Kdaktif',
				't_psaktifket' => 'T Psaktifket',
				'd_joinunit' => 'Join Date',
				'd_joingrp' => 'D Joingrp',
				'b_sambung' => 'B Sambung',
				'c_pathfoto' => 'Photo',
				'userid' => 'Userid',
				'tglmodify' => 'Tglmodify',
				'pt_kodept' => 'Pt Kodept',
				'py_kodeproyek' => 'Py Kodeproyek',
				't_status' => 'T Status',
				't_status2' => 'T Status2',
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
		$criteria->compare('c_hriskd',$this->c_hriskd,true);
		$criteria->compare('c_proyek',$this->c_proyek,true);
		$criteria->compare('c_pt',$this->c_pt,true);
		$criteria->compare('c_direktorat',$this->c_direktorat,true);
		$criteria->compare('c_pskode',$this->c_pskode,true);
		$criteria->compare('vc_psnama',$this->vc_psnama,true);
		$criteria->compare('vc_pstemlhr',$this->vc_pstemlhr,true);
		$criteria->compare('d_pstgllhr',$this->d_pstgllhr,true);
		$criteria->compare('b_psjkel',$this->b_psjkel);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				//'pagination'=>false
		));
	}

	public function listWaitingApproval()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('leave');
		$criteria->together=true;
		$criteria->compare('leave.approved_id',1);
		$criteria->compare('leave.d_dari>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				//'pagination'=>false,
		));
	}

	public function onPending()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('leave');
		$criteria->together=true;
		$criteria->compare('leave.approved_id',4);
		//$criteria->compare('leave.d_dari>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				//'pagination'=>false,
		));
	}

	public function onLeave()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('leave');
		$criteria->compare('leave.approved_id',2);
		$criteria->compare('leave.d_dari>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				//'pagination'=>false,
		));
	}

	public function recentLeave()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('leave');
		$criteria->compare('leave.approved_id',2);
		$criteria->order='leave.d_sampai DESC';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>50,
				),
		));
	}
/*
	public static function ListWaitingApproval()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->with=array('leave');
		//$criteria->together=true;
		//$criteria->compare('leave.approved_id',1);
		//$criteria->compare('leave.d_dari>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			//$_nama= (strlen($model->vc_psnama) >15) ? substr($model->vc_psnama,0,15)."..." : $model->vc_psnama;
			//$_nama= $model->vc_psnama;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('/m1/gLeave/view','id'=>$model->id));
		}

		return $returnarray;
	}
*/

	public static function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$_nama= (strlen($model->vc_psnama) >15) ? substr($model->vc_psnama,0,15)."..." : $model->vc_psnama;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('/m1/gPerson/view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$_nama= (strlen($model->vc_psnama) >15) ? substr($model->vc_psnama,0,15)."..." : $model->vc_psnama;
			$returnarray[] = array('id' => $model->id, 'label' => $_nama, 'icon'=>'list-alt', 'url' => array('/m1/gPerson/view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopRelated($name) {

		//$_related = self::model()->find((int)$id)->account_name;
		$_exp=explode(" ",$name);


		$criteria=new CDbCriteria;
		//$criteria->compare('account_name',$_related,true,'OR');

		if (isset($_exp[0]))
			$criteria->compare('account_name',$_exp[0],true,'OR');

		if (isset($_exp[1]))
			$criteria->compare('account_name',$_exp[1],true,'OR');
			
		$criteria->limit=10;
		$criteria->order='updated_date DESC';

		$models=self::model()->findAll($criteria);

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->vc_psnama, 'url' => array('/m1/gPerson/view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getJKelamin()
	{
		return array(
				'1'=>'Laki-laki',
				'2'=>'Perempuan',
		);
	}

}