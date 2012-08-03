<?php

/**
 * This is the model class for table "d_eventmgmt".
 *
 * The followings are the available columns in table 'd_eventmgmt':
 * @property integer $id
 * @property integer $event_id
 * @property string $issue_number
 * @property integer $category_id
 * @property string $issue
 * @property string $person_incharge
 * @property string $todo
 * @property integer $progress
 * @property string $incomplete_exp
 * @property string $remark
 */
class dEventmgmt extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DEventmgmt the static model class
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
		return 'd_eventmgmt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('progress, issue, person_incharge, todo', 'required'),
				array('event_id, category_id, progress', 'numerical', 'integerOnly'=>true),
				array('issue_number', 'length', 'max'=>15),
				array('issue', 'length', 'max'=>100),
				array('person_incharge', 'length', 'max'=>50),
				array('todo, incomplete_exp, remark', 'length', 'max'=>255),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, event_id, issue_number, category_id, issue, person_incharge, todo, progress, incomplete_exp, remark', 'safe', 'on'=>'search'),
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
				'event_id' => 'Event',
				'issue_number' => 'Issue Number',
				'category_id' => 'Category',
				'issue' => 'Issue',
				'person_incharge' => 'Person Incharge',
				'todo' => 'Todo',
				'progress' => 'Progress',
				'incomplete_exp' => 'Incomplete Exp',
				'remark' => 'Remark',
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
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('issue_number',$this->issue_number,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('issue',$this->issue,true);
		$criteria->compare('person_incharge',$this->person_incharge,true);
		$criteria->compare('todo',$this->todo,true);
		$criteria->compare('progress',$this->progress);
		$criteria->compare('incomplete_exp',$this->incomplete_exp,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->order = 'event_id';

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>30,
				),
		));
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord) {
				$this->created_date=time();
				$this->created_by= yii::app()->user->name;
			} else {
				$this->updated_date=time();
				$this->updated_by= yii::app()->user->name;
			}
			return true;
		}
		else
			return false;
	}

	public function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->user_ref, 'label' => $model->user_ref, 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopUpdated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->user_ref, 'label' => $model->user_ref, 'url' => array('view','id'=>$model->id));
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
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->account_no . " ".$model->account_name, 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function behaviors()
	{
		return array(
				'datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'),
				'defaults'=>array(
						'class'=>'ext.decimali18nbehavior.DecimalI18NBehavior',
						//'format'=>'db',
				),
		);
	}



}