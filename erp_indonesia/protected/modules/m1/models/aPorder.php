<?php

/**
 * This is the model class for table "a_porder".
 *
 * The followings are the available columns in table 'a_porder':
 * @property integer $id
 * @property integer $organization_id
 * @property string $input_date
 * @property string $af_date
 * @property string $no_ref
 * @property integer $periode_date
 * @property integer $budgetcomp_id
 * @property integer $approved_date
 * @property string $remark
 * @property integer $issuer_id
 * @property integer $payment_state_id
 * @property string $payment_date
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class aPorder extends BaseModel
{
	public $budget_id;
	public $department_id;
	public $description;
	public $user;
	public $qty;
	public $amount;


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return aPorder the static model class
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
		return 'a_porder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('input_date, no_ref, periode_date, budgetcomp_id', 'required'),
				array('organization_id, periode_date, budgetcomp_id, approved_date, issuer_id, payment_state_id, created_date, updated_date', 'numerical', 'integerOnly'=>true),
				array('no_ref', 'length', 'max'=>100),
				array('created_by, updated_by', 'length', 'max'=>15),
				array('af_date, remark, payment_date', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, organization_id, input_date, af_date, no_ref, periode_date, budgetcomp_id, approved_date, remark, issuer_id, payment_state_id, payment_date, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'sum_po' => array(self::STAT, 'aPorderDetail', 'parent_id','select'=>'sum(qty*amount)'),
				'po_detail' => array(self::HAS_MANY, 'aPorderDetail', 'parent_id'),
				'po_detail_group' => array(self::HAS_MANY, 'aPorderDetail', 'parent_id','group'=>'t.id, po_detail_group.id,po_detail_group.budget_id,po_detail_group.department_id','select'=>'*,sum(po_detail_group.amount) as sub_total'),
				'budgetcomp' => array(self::BELONGS_TO, 'aBudget', 'budgetcomp_id'),
				'organization' => array(self::BELONGS_TO, 'aOrganization', 'organization_id'),
				'payment' => array(self::BELONGS_TO, 'sParameter', array('payment_state_id'=>'code'),'condition'=>'type = \'cPayment\''),
				'issuer' => array(self::BELONGS_TO, 'sParameter', array('issuer_id'=>'code'),'condition'=>'type = \'cIssuer\''),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'organization_id' => 'Organization',
				'input_date' => 'Input Date',
				'af_date' => 'AF Date',
				'no_ref' => 'No Ref',
				'periode_date' => 'Periode Date',
				'budgetcomp_id' => 'Budget Component',
				'approved_date' => 'Approved Date',
				'remark' => 'Remark',
				'issuer_id' => 'Issuer',
				'payment_state_id' => 'Payment State',
				'payment_date' => 'Payment Date',
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
	public function search($id=0)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('budgetcomp');

		if ($id == 1) {
			$criteria->condition='approved_date is null AND budgetcomp.parent_id = 300';
		} elseif ($id == 2) {
			$criteria->condition='approved_date is not null AND payment_state_id = 1 AND budgetcomp.parent_id = 300';
		} elseif ($id == 3)
		$criteria->condition='approved_date is not null AND payment_state_id = 2 AND budgetcomp.parent_id = 300';

		$criteria->order='t.id DESC';

		if (Yii::app()->user->name != "admin")
			$criteria->addInCondition('organization_id',sUser::model()->getGroupArray());

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>30
				)
		));
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search07($id=0)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('budgetcomp');

		if ($id == 1) {
			$criteria->condition='approved_date is null AND budgetcomp.parent_id = 1001';
		} elseif ($id == 2) {
			$criteria->condition='approved_date is not null AND payment_state_id = 1 AND budgetcomp.parent_id = 1001';
		} elseif ($id == 3)
		$criteria->condition='approved_date is not null AND payment_state_id = 2 AND budgetcomp.parent_id = 1001';

		$criteria->order='t.id DESC';

		if (Yii::app()->user->name != "admin")
			$criteria->addInCondition('organization_id',sUser::model()->getGroupArray());

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>30
				)
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function approvalForm($id=0,$cid=null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if ($id == 1) {
			$criteria->condition='approved_date is null';
		} elseif ($id == 2) {
			$criteria->condition='approved_date is not null AND payment_state_id = 1';
		} elseif ($id == 3)
		$criteria->condition='approved_date is not null AND payment_state_id = 3';

		//$criteria->compare('payment_state_id',1);
		$criteria->compare('budgetcomp_id',$cid);
		$criteria->compare('no_ref',$this->no_ref,true);
		$criteria->order='no_ref DESC';

		return new CActiveDataProvider(get_class($this), array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>50
				)
		));
	}

	public function sum_pof() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->sum_po);

		return $_format;
	}

	public function getTopCreated() {

		$models=self::model()->with('budgetcomp')->findAll(array('condition'=>'budgetcomp.parent_id = 300','limit'=>10,'order'=>'t.created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$_no_ref= (strlen($model->no_ref) >15) ? substr($model->no_ref,0,15)."..." : $model->no_ref;

			$returnarray[] = array('id' => $model->no_ref, 'label' => $_no_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopUpdated() {

		$models=self::model()->with('budgetcomp')->findAll(array('condition'=>'budgetcomp.parent_id = 300','limit'=>10,'order'=>'t.updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$_no_ref= (strlen($model->no_ref) >15) ? substr($model->no_ref,0,15)."..." : $model->no_ref;

			$returnarray[] = array('id' => $model->no_ref, 'label' => $_no_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopCreated07() {

		$models=self::model()->with('budgetcomp')->findAll(array('condition'=>'budgetcomp.parent_id = 1001','limit'=>10,'order'=>'t.created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$_no_ref= (strlen($model->no_ref) >15) ? substr($model->no_ref,0,15)."..." : $model->no_ref;

			$returnarray[] = array('id' => $model->no_ref, 'label' => $_no_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
		}

		return $returnarray;
	}

	public function getTopUpdated07() {

		$models=self::model()->with('budgetcomp')->findAll(array('condition'=>'budgetcomp.parent_id = 1001','limit'=>10,'order'=>'t.updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$_no_ref= (strlen($model->no_ref) >15) ? substr($model->no_ref,0,15)."..." : $model->no_ref;

			$returnarray[] = array('id' => $model->no_ref, 'label' => $_no_ref, 'icon'=>'list-alt', 'url' => array('view','id'=>$model->id));
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

	public function getWaitingApproval() {
		return self::count('approved_date is null');
	}

	public function getWaitingPayment() {
		return self::count('approved_date is not null AND payment_state_id = 1');
	}

	public function getNewlyPO() {
		//return self::count('from_unixtime(created_date) > date_sub(curdate(), interval 1 week)');
		return 100;
	}

}