<?php

class sUser extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_user';
	}

	public function rules()
	{
		return array(
				array('username, password, default_group, status_id', 'required'),
				array('status_id, default_group, status_id, created_date', 'numerical', 'integerOnly'=>true),
				array('username, created_by', 'length', 'max'=>15),
				array('password, salt, ', 'length', 'max'=>100),
				array('last_login', 'safe'),
				array('username, default_group, status_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'organization' => array(self::BELONGS_TO, 'aOrganization', 'default_group'),
				'status' => array(self::HAS_ONE, 'sParameter', array('code'=>'status_id'),'condition'=>'type = "cStatus"'),
				'module' => array(self::HAS_MANY, 'sUserModule', 's_user_id'),
				'moduleList' => array(self::MANY_MANY, 'sModule','s_user_module(s_user_id,s_module_id)'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'username' => 'Username',
				'password' => 'Password',
				'salt' => 'Salt',
				'default_group' => 'Default Group',
				'status_id' => 'Status',
				'created_date' => 'Created Date',
				'created_by' => 'Created By',
				'last_login' => 'Last Login',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}

	public function searchModule($id)
	{
		$criteria=new CDbCriteria;
		$criteria->join='LEFT JOIN s_user_module b ON t.id = b.s_user_id';
		$criteria->condition='b.s_module_id = :id';
		$criteria->params=array(':id'=>$id);

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		if($this->isNewRecord) {
			$this->salt=$this->generateSalt();
			$this->password=md5($this->salt.$this->password);
			$this->created_by=Yii::app()->user->id;
			$this->created_date=time();
		} else {
			$this->created_by=Yii::app()->user->id;
			$this->created_date=time();
		}
			
		return parent::beforeSave();

	}

	public function generateSalt()
	{
		return uniqid('',true);
	}

	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}

	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}


	public function allUsers($all='')
	{
		$_items=array();
		$models=$this->findAll(array('order'=>'username'));
		if ($all='all') {
			self::$_items[0]='All';
		}

		foreach($models as $model)
			self::$_items[$model->id]=$model->username;

		return self::$_items;

	}

	public function findName($id)
	{
		$model=$this->findByPk((int)$id);
		if ($model == null)
			return "All";
			
		return $model->username;

	}


	private static $_items2=array();
	private static $_admin2=array('admin');

	public static function items2($type) {
		if(!isset(self::$_items2[$type]))
			self::loadItems2($type);
		return array_merge(self::$_admin2,self::$_items2[$type]);
	}

	private static function loadItems2($type)
	{
		self::$_items2[$type]=array();
		$models2=self::model()->findAllBySql('SELECT a.id, a.username FROM s_user a
				INNER JOIN s_user_module b ON a.id = b.s_user_id
				WHERE b.s_module_id = "' . $type . '"');
		foreach($models2 as $model2) {
			self::$_items2[$type][$model2->id]=$model2->username;
		}
	}


	private static $_items=array();
	private static $_admin=array('admin');

	public static function items($type) {
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return array_merge(self::$_admin,self::$_items[$type]);
	}

	private static function loadItems($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAllBySql('SELECT a.id, a.username FROM s_user a
				INNER JOIN s_user_module b ON a.id = b.s_user_id
				WHERE b.s_matrix_id = 5 and b.s_module_id = "' . $type . '"');
		foreach($models as $model) {
			self::$_items[$type][$model->id]=$model->username;
		}
	}


	private static $_items1=array();

	public static function items1($type)
	{
		if(!isset(self::$_items1[$type]))
			self::loadItems1($type);
		return self::$_items1[$type];
	}


	private static function loadItems1($type)
	{
		self::$_items1[$type]=array();
		if(Yii::app()->user->id===null) {
			self::$_items1[$type][1]='nonregisteraction';
		} else {

			$model=sUserModule::model()->findBySql('SELECT a.id, a.s_matrix_id FROM s_user_module a
					WHERE a.s_user_id = ' .Yii::app()->user->id . ' AND a.s_module_id = ' . $type . '');

			if($model===null) {
				self::$_items1[$type][1]='nonregisteraction';
			}
			else {
				if (Yii::app()->user->name !='admin') {
					if ($model->s_matrix_id ==1) {      //viewer
						self::$_items1[$type][1]='index';
						self::$_items1[$type][2]='view';
						self::$_items1[$type][3]='admin';
					} elseif ($model->s_matrix_id ==4) {    //Approval Level, Update Only, Create and Delete REJECTED
						self::$_items1[$type][1]='index';
						self::$_items1[$type][2]='view';
						self::$_items1[$type][3]='admin';
						self::$_items1[$type][4]='update';
						self::$_items1[$type][5]='updateg';
						self::$_items1[$type][6]='updateh';
					} elseif ($model->s_matrix_id ==8) {    //Approval++ Level, Update+Create but Delete REJECTED
						self::$_items1[$type][1]='index';
						self::$_items1[$type][2]='view';
						self::$_items1[$type][3]='admin';
						self::$_items1[$type][5]='update';
						self::$_items1[$type][7]='updateg';
						self::$_items1[$type][8]='updateh';
						self::$_items1[$type][9]='create';
					}
				}
			}
		}
	}

	public function getGroup()
	{
		$_group=self::findByPk(Yii::app()->user->id)->default_group;
		return $_group;
	}

	public function getGroupArray()
	{
		$models=sGroup::model()->findAll('parent_id = '.Yii::app()->user->id);

		//Default Group as the first array
		$_items[]=$this->getGroup();

		foreach($models as $model)
			$_items[]=$model->organization_root_id;

		return $_items;
	}

	public function getGroupRoot()
	{
		$model=self::findByPk((int)Yii::app()->user->id);

		if ($model->organization->parent_id == 0) { //L1
			$_groupRoot=$model->organization->id;
		} elseif ($model->organization->getparent->parent_id == 0) { //L2
			$_groupRoot=$model->organization->getparent->id;
		} elseif ($model->organization->getparent->getparent->parent_id == 0) { //L3
			$_groupRoot=$model->organization->getparent->getparent->id;
		} else  //L4
			$_groupRoot=$model->organization->getparent->getparent->getparent->id;

		return $_groupRoot;
	}

	public function getGroupRootName()
	{
		$model=self::findByPk((int)Yii::app()->user->id);

		if ($model->organization->parent_id == 0) { //L1
			$_groupRoot=$model->organization->name;
		} elseif ($model->organization->getparent->parent_id == 0) { //L2
			$_groupRoot=$model->organization->getparent->name;
		} elseif ($model->organization->getparent->getparent->parent_id == 0) { //L3
			$_groupRoot=$model->organization->getparent->getparent->name;
		} else  //L4
			$_groupRoot=$model->organization->getparent->getparent->getparent->name;

		return $_groupRoot;
	}

	public function getAccess($mid)
	{
		$_items=array();
		$models=self::model()->findAllBySql('SELECT a.id, a.username FROM s_user a
				INNER JOIN s_user_module b ON a.id = b.s_user_id
				WHERE b.s_module_id = ' . $mid );
		$_items[]='admin';

		if ($models != null) {
			foreach($models as $model) {
				$_items[$model->id]=$model->username;
			}
		} else
			$_items[]='non_registered_user';

		return $_items;
	}

	public function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->username, 'label' => $model->username, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopRelated($id) {

		$_related = self::model()->findByPk((int)$id)->name;
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
			$returnarray[] = array('id' => $model->username, 'label' => $model->username, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}


}