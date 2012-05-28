<?php

class aOrganization extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'a_organization';
	}

	public function rules()
	{
		return array(
				array('branch_code, structure_id, propinsi_id', 'required'),
				array('kabupaten_id, propinsi_id, created_date, created_id, updated_date, updated_id, parent_id', 'numerical', 'integerOnly'=>true),
				array('branch_code, structure_id, name, address, address2, address3, address4, pos_code, phone_code_area, telephone, fax, email, website', 'length', 'max'=>50),
					
				array('id, branch_code, structure_id, name, address, address2, address3, address4, pos_code, phone_code_area, telephone, fax, email, website, created_date, created_id, updated_date, updated_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'getparent' => array(self::BELONGS_TO, 'aOrganization', 'parent_id'),
				'childs' => array(self::HAS_MANY, 'aOrganization', 'parent_id', 'order' => 'id ASC'),
				'entityAccount' => array(self::HAS_MANY, 'aAccountEntity', 'entity_id', 'order' => 'id ASC'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent ID',
				'branch_code' => 'Branch Code',
				'structure_id' => 'Structure',
				'name' => 'Name',
				'address' => 'address',
				'address2' => 'address2',
				'address3' => 'address3',
				'address4' => 'address4',
				'kabupaten_id' => 'Kab/Kodya',
				'propinsi_id' => 'Propinsi',
				'pos_code' => 'Kode Pos',
				'phone_code_area' => 'Kode Area',
				'telephone' => 'telephone',
				'fax' => 'Fax',
				'email' => 'Email',
				'website' => 'Website',
				'created_date' => 'Created Date',
				'created_id' => 'Created',
				'updated_date' => 'Updated Date',
				'updated_id' => 'Updated',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function getTree() {
		$subitems = array();

		if($this->childs) foreach($this->childs as $child) {
			$subitems[] = $child->getTree();
		}

		$returnarray = array(
				'text' => CHtml::link($this->name,Yii::app()->createUrl('/aOrganization/view',array('id'=>$this->id))));

		if($subitems != array())
			$returnarray = array_merge($returnarray, array('children' => $subitems));
		return $returnarray;
	}

	public static function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopRelated($id) {

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
			$returnarray[] = array('id' => $model->name, 'label' => $model->name, 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord) {
				$this->created_date=time();
				$this->created_id= yii::app()->user->id;
			} else {
				$this->updated_date=time();
				$this->updated_id= yii::app()->user->id;
			}
			return true;
		}
		else
			return false;
	}

	public function behaviors()
	{
		return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'));
	}

	public static function items()
	{

		$models=self::model()->findAll();

		foreach($models as $model) {
			$_items[$model->id]=$model->name;
		}

		return $_items;
	}

	/////////////////////////////////////////////
	public function getRootList() {

		$models=self::model()->findAll(array('condition'=>'parent_id = 0'));


		$_items=array();

		foreach($models as $model)
			$_items[$model->id]=$model->name;

		return $_items;
	}

	/////////////////////////////////////////////
	public function getListProject() {

		$models=self::model()->findAll('parent_id ='.sUser::model()->getGroupRoot());


		$_items=array();

		$_items[sUser::model()->getGroupRoot()]="(ALL)";

		foreach($models as $model)
			foreach($model->childs as $mod)
			$_items[$mod->id]=$mod->name;

		return $_items;
	}

	public function getTopLevel() {
		if ($this->parent_id == 0) {
			$_level=$this->name;
		} elseif ($this->getparent->parent_id == 0) {
			$_level=$this->getparent->name;
		} elseif ($this->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->name;
		} elseif ($this->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->name;
		} elseif ($this->getparent->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->getparent->name;
		} elseif ($this->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->getparent->getparent->name;
		}

		return $_level;
	}

	public function getTopLevelId() {
		if ($this->parent_id == 0) {
			$_level=$this->id;
		} elseif ($this->getparent->parent_id == 0) {
			$_level=$this->getparent->id;
		} elseif ($this->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->id;
		} elseif ($this->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->id;
		} elseif ($this->getparent->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->getparent->id;
		} elseif ($this->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
			$_level=$this->getparent->getparent->getparent->getparent->getparent->id;
		}

		return $_level;
	}

}