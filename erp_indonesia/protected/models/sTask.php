<?php

/**
 * This is the model class for table "s_task".
 *
 * The followings are the available columns in table 's_task':
 * @property integer $id
 * @property string $subject
 * @property string $start_date
 * @property string $end_date
 * @property string $reminder
 * @property integer $status_id
 * @property integer $priority_id
 * @property integer $category_id
 * @property integer $mark_id
 * @property string $notes
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class sTask extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return STask the static model class
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
		return 's_task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('subject', 'required'),
				array('status_id, priority_id, category_id, mark_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly'=>true),
				array('subject', 'length', 'max'=>150),
				array('notes', 'length', 'max'=>500),
				array('start_date, end_date, reminder', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, subject, start_date, end_date, reminder, status_id, priority_id, category_id, mark_id, notes, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'subject' => 'Subject',
				'start_date' => 'Start Date',
				'end_date' => 'End Date',
				'reminder' => 'Reminder',
				'status_id' => 'Status',
				'priority_id' => 'Priority',
				'category_id' => 'Category',
				'mark_id' => 'Mark',
				'notes' => 'Notes',
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

		$criteria->compare('created_by',Yii::app()->user->id);
		$criteria->order='created_date DESC';

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}


	public function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->user_ref, 'label' => $model->user_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopUpdated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->user_ref, 'label' => $model->user_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
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
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->account_no . " ".$model->account_name, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}


}