<?php

/**
 * This is the model class for table "a_budget".
 *
 * The followings are the available columns in table 'a_budget':
 * @property string $id
 * @property string $parent_id
 * @property integer $year
 * @property string $code
 * @property string $name
 * @property string $unit
 * @property string $amount
 * @property string $remark
 * @property string $jan
 * @property string $feb
 * @property string $mar
 * @property string $apr
 * @property string $mei
 * @property string $jun
 * @property string $jul
 * @property string $agt
 * @property string $sep
 * @property string $okt
 * @property string $nov
 * @property string $des
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class aBudget extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return aBudget the static model class
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
		return 'a_budget';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id', 'required'),
				array('year, created_date, status_id, updated_date', 'numerical', 'integerOnly'=>true),
				array('parent_id', 'length', 'max'=>11),
				array('code', 'length', 'max'=>25),
				array('name', 'length', 'max'=>50),
				array('unit, amount, jan, feb, mar, apr, mei, jun, jul, agt, sep, okt, nov, des, created_by, updated_by', 'length', 'max'=>15),
				array('remark', 'length', 'max'=>255),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('parent_id, year, code, name, unit, amount, remark, jan, feb, mar, apr, mei, jun, jul, agt, sep, okt, nov, des, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
				'getparent' => array(self::BELONGS_TO, 'aBudget', 'parent_id'),
				'childsOld' => array(self::HAS_MANY, 'aBudget', 'parent_id','order' => 'code'),
				'ch' => array(self::HAS_MANY, 'aBudget', 'parent_id', 'order' => 'code'),
				'childs' => array(self::HAS_MANY, 'aOrganization', array('department_id'=>'id'),'through'=>'ch','condition'=>'childs.parent_id = 0'),
				'childsDept' => array(self::HAS_MANY, 'aOrganization', array('department_id'=>'id'),'through'=>'ch','condition'=>'childsDept.parent_id <> 0'),
				'total_af' => array(self::STAT, 'aBudgetDetail', 'parent_id','select'=>'count(id)','condition'=>'tcredit != 0'),
				'total_af_all' => array(self::STAT, 'aPorder', 'budgetcomp_id'),
				'end_balance' => array(self::HAS_ONE, 'aBudgetDetail', 'parent_id','select'=>'balance','order'=>'end_balance.id DESC'),
				'sum_af' => array(self::STAT, 'aBudget', 'parent_id','select'=>'sum(amount)'),
				'sum_budget' => array(self::STAT, 'aBudgetDetail', 'parent_id','select'=>'sum(tcredit)'),
				'department' => array(self::BELONGS_TO, 'aOrganization', 'department_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'parent_id' => 'Parent',
				'year' => 'Year',
				'code' => 'Code',
				'name' => 'Name',
				'unit' => 'Unit',
				'amount' => 'Amount',
				'remark' => 'Remark',
				'jan' => 'Jan',
				'feb' => 'Feb',
				'mar' => 'Mar',
				'apr' => 'Apr',
				'mei' => 'Mei',
				'jun' => 'Jun',
				'jul' => 'Jul',
				'agt' => 'Agt',
				'sep' => 'Sep',
				'okt' => 'Okt',
				'nov' => 'Nov',
				'des' => 'Des',
				'status_id' => 'Status',
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
	public function search($id,$pro_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);
		$criteria->compare('department_id',$pro_id);
		$criteria->compare('year',$this->year);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>50
				),
				'sort'=>array(
						'defaultOrder'=>'code',
				)
		));
	}

	public function sum_aff() {

		$_counter=0;

		foreach ($this->childs as $child) {
			if ($child->childs) {
				$_counter=$_counter+$child->sum_af;
			} else {
				$_counter=$this->sum_af;
			}
		}

		$_format=Yii::app()->numberFormatter->format("#,##0",$_counter);
			
		return $_format;
	}

	public function amountf() {
		$_format=Yii::app()->numberFormatter->format("#,##0.00",$this->amount);

		return $_format;
	}

	public function perBudgetModel($id,$pro_id=null)  ///WARNING!!! WATCHING COULD ERROR
	{

		$rawData=Yii::app()->db->createCommand(
				'
				SELECT a.name, a.amount AS Total,
				(
				SELECT sum(d.qty * d.amount)

				FROM a_porder c
				INNER JOIN a_porder_detail d ON d.parent_id = c.id
				WHERE

				c.approved_date is not null
				/*AND substr(ltrim(to_char(b.periode_date,\'999999\'))1,4) = \'2012\' */
				AND LEFT(c.periode_date,4) = \'2012\'
				AND c.budgetcomp_id = a.id
		) AS Realisasi

				FROM a_budget a

				WHERE a.parent_id = '.$id.'
				AND a.year = \'2012\'
				ORDER BY a.code
				'
		)->queryAll();



		foreach ($rawData as $key => $value) {
			foreach ($value as $key1 => $value1) {
				if ($key1 == 'Total') {
					$rawData1a['name']='Total';
					$rawData2a[]=(int)$value1;
				} elseif ($key1 == 'Realisasi') {
					$rawData1b['name']='Realisasi';
					$rawData2b[]=(int)$value1;
				} else {

				}
			}
		}

		$rawData3a['data']=$rawData2a;
		$rawData3b['data']=$rawData2b;
		$rawDataRet[]=array_merge($rawData1a,$rawData3a);
		$rawDataRet[]=array_merge($rawData1b,$rawData3b);

		return $rawDataRet;
	}

	//public function perBudgetModelCat($id,$pro_id)  ///WARNING!!! WATCHING COULD ERROR
	public function perBudgetModelCat($id,$pro_id=null)
	{
		$criteria=new CDBcriteria;
		$criteria->compare('parent_id',$id);
		//$criteria->compare('department_id',$pro_id);
		$criteria->order='code';

		$models=self::model()->findAll($criteria);
		foreach($models as $model)
			$_items[]=$model->code;
			
		return $_items;

	}

	public function perSubBudgetModel($id) //masih salah
	{

		$rawData=Yii::app()->db->createCommand(
				'
				SELECT a.name, a.amount AS Total,
				(
				SELECT sum(d.qty * d.amount)

				FROM a_porder c
				INNER JOIN a_porder_detail d ON d.parent_id = c.id
				WHERE

				c.approved_date is not null
				AND LEFT(c.periode_date,4) = \'2012\'
				/*AND substr(ltrim(to_char(c.periode_date,\'999999\'))1,4) = \''.$year.'\'*/
				AND d.budget_id = a.id
		) AS Realisasi

				FROM a_budget a

				WHERE a.id = '.$id.'
				AND a.year = \'2012\'
				ORDER BY a.code
				'
		)->queryAll();



		foreach ($rawData as $key => $value) {
			foreach ($value as $key1 => $value1) {
				if ($key1 == 'Total') {
					$rawData1a['name']='Total';
					$rawData2a[]=(int)$value1;
				} elseif ($key1 == 'Realisasi') {
					$rawData1b['name']='Realisasi';
					$rawData2b[]=(int)$value1;
				} else {

				}
			}
		}

		$rawData3a['data']=$rawData2a;
		$rawData3b['data']=$rawData2b;
		$rawDataRet[]=array_merge($rawData1a,$rawData3a);
		$rawDataRet[]=array_merge($rawData1b,$rawData3b);

		return $rawDataRet;
	}

	public function getData($cnd = " = 0") {
		$data = array();
		foreach(aBudget::model()->findAll('parent_id '.$cnd.' ORDER BY code') as $model) {
			$row['text'] = $model->name;
			$row['id'] = $model->id;
			$row['children'] = aBudget::model()->getData(' = '.$model->id);
			$data[] = $row;
		}
		return $data;
	}

	public static function mainComponent($id=null) //$id = for filterisasi by Spesific COmponent
	{
		$_items=array();

		$criteria=new CDbCriteria;
		$criteria->order='code';

		if (Yii::app()->user->name !='admin')
			$criteria->addInCondition('department_id',array(sUser::model()->getGroupRoot()));
		//$criteria->addInCondition('department_id',array(1));

		if ($id ==null) {
			$criteria->compare('parent_id',300);
			$models=self::model()->findAll($criteria);
		} else {
			$criteria->compare('id',$id);
			$models=self::model()->findAll($criteria);
		}

		$_items[""]="ALL";

		foreach($models as $model)
			$_items[$model->id]=$model->code.". ".$model->name." (" .$model->department->name.")";

		return $_items;
	}

	public static function mainComponent07($id=null) //$id = for filterisasi by Spesific COmponent
	{
		$_items=array();

		$criteria=new CDbCriteria;
		$criteria->order='code';

		if (Yii::app()->user->name !='admin')
			$criteria->addInCondition('department_id',array(sUser::model()->getGroupRoot()));
		//$criteria->addInCondition('department_id',array(1));

		if ($id ==null) {
			$criteria->compare('parent_id',1001);
			$models=self::model()->findAll($criteria);
		} else {
			$criteria->compare('id',$id);
			$models=self::model()->findAll($criteria);
		}

		$_items[""]="ALL";

		foreach($models as $model)
			$_items[$model->id]=$model->code.". ".$model->name." (" .$model->department->name.")";

		return $_items;
	}

	public function getTotalComponent($id=0)
	{

		$models=self::model()->findAll(array(
			'condition'=>'department_id = 1 and parent_id = :id',
			'params'=>array(':id'=>$id),
		));
		
		$_total=0;

		foreach($models as $model)
			$_total=$_total+$model->amount;

		$_total=Yii::app()->numberFormatter->format("#,##0.00",$_total);

		return $_total;

	}

	public function getTotalComponentR($id=null)
	{

		$criteria=new CDbCriteria;
		$criteria->compare('parent_id',$id);
		$models=aBudgetDetail::model()->findAll($criteria);
		$_total=0;

		foreach($models as $model)
			$_total=$_total+$model->tcredit;

		$_total=Yii::app()->numberFormatter->format("#,##0.00",$_total);

		return $_total;

	}

	public static function nonMainComponent()
	{
		$_items=array();

		$criteria=new CDbCriteria;
		$criteria->order='code';
		$criteria->compare('parent_id!',300);
		$criteria->compare('LEFT(t.code,3)','C06');
		$criteria->compare('status_id',1);

		if (Yii::app()->user->name !='admin') {
			$criteria->compare('department_id',sUser::model()->getGroupRoot());
		}

		$models=self::model()->findAll($criteria);
			
		foreach($models as $model) {
			if (!$model->childs) {
				if (Yii::app()->user->name =='admin') {
					$_items[$model->getparent->code ." ". $model->getparent->name][$model->id]=$model->code." ".$model->name." (".$model->department->name.")";
				} else
					$_items[$model->getparent->code ." ". $model->getparent->name][$model->id]=$model->code." ".$model->name;
			}
		}

		return $_items;
	}

	public static function nonMainComponent07()
	{
		$_items=array();

		$criteria=new CDbCriteria;
		$criteria->order='code';
		$criteria->compare('t.parent_id!',1001);
		$criteria->compare('LEFT(t.code,3)','C07');
		$criteria->compare('t.status_id',1);

		if (Yii::app()->user->name !='admin') {
			$criteria->compare('department_id',sUser::model()->getGroupRoot());
		}

		$models=self::model()->findAll($criteria);
			
		foreach($models as $model) {
			if (!$model->childs) {
				if (Yii::app()->user->name =='admin') {
					$_items[$model->getparent->code ." ". $model->getparent->name][$model->id]=$model->code." ".$model->name." (".$model->department->name.")";
				} else
					$_items[$model->getparent->code ." ". $model->getparent->name][$model->id]=$model->code." ".$model->name;
			}
		}

		return $_items;
	}

	public function allComponent($id,$year,$format=0)
	{
		$rawData=Yii::app()->db->createCommand(
				'
				SELECT sum(a.amount) as Total

				FROM a_porder_detail a
				INNER JOIN a_porder b ON b.id = a.parent_id
				WHERE

				b.approved_date is not null
				/*AND substr(ltrim(to_char(b.periode_date,\'999999\')),1,4) = \''.$year.'\'*/
				AND LEFT(b.periode_date,4) = \''.$year.'\'
				AND b.budgetcomp_id = '.$id
		)->queryAll();

		foreach ($rawData as $key => $value)
			foreach ($value as $key1 => $value1)
				
			if ($format ==0) {
			return Yii::app()->numberFormatter->format("#,##0.00",$value1);
		} else
			return $value1;

	}

	public function allComponentPaid($id,$year,$format=0)
	{
		$rawData=Yii::app()->db->createCommand(
				'
				SELECT sum(a.qty * a.amount) as Total

				FROM a_porder_detail a
				INNER JOIN a_porder b ON b.id = a.parent_id
				WHERE

				b.approved_date is not null
				AND a.detail_payment_id = 3
				/*AND substr(ltrim(to_char(b.periode_date,\'999999\')),1,4) = \''.$year.'\'  */
				AND LEFT(b.periode_date,4) = \''.$year.'\'
				AND b.budgetcomp_id = '.$id
		)->queryAll();

		foreach ($rawData as $key => $value)
			foreach ($value as $key1 => $value1)

			if ($format ==0) {
			return Yii::app()->numberFormatter->format("#,##0.00",$value1);
		} else
			return $value1;

	}

	public function allSubComponent($id,$year)
	{
		$rawData=Yii::app()->db->createCommand(
				'
				SELECT sum(a.qty * a.amount) as Total

				FROM a_porder_detail a
				INNER JOIN a_porder b ON b.id = a.parent_id
				WHERE

				b.approved_date is not null
				/*AND substr(ltrim(to_char(b.periode_date,\'999999\'))1,4) = \''.$year.'\' */
				AND LEFT(b.periode_date,4) = '.$year.'
				AND a.budget_id = '.$id
		)->queryAll();

		foreach ($rawData as $key => $value)
			foreach ($value as $key1 => $value1)
			return Yii::app()->numberFormatter->format("#,##0.00",$value1);

	}

	public function allSubComponentPaid($id,$year)
	{
		$rawData=Yii::app()->db->createCommand(
				'
				SELECT sum(a.qty * a.amount) as Total

				FROM a_porder_detail a
				INNER JOIN a_porder b ON b.id = a.parent_id
				WHERE

				b.approved_date is not null
				AND a.detail_payment_id = 3
				AND LEFT(b.periode_date,4) = '.$year.'
				/*AND substr(ltrim(to_char(b.periode_date,\'999999\'))1,4) = \''.$year.'\' */
				AND a.budget_id = '.$id
		)->queryAll();

		foreach ($rawData as $key => $value)
			foreach ($value as $key1 => $value1)
			return Yii::app()->numberFormatter->format("#,##0.00",$value1);

	}

	public function perBulan($pid)
	{
		$rawData=Yii::app()->db->createCommand(
				'select c.id, c.code,c.name, c.amount,
				sum(if(b.periode_date=201201,a.amount,0)) as "201201",
				sum(if(b.periode_date=201202,a.amount,0)) as "201202",
				sum(if(b.periode_date=201203,a.amount,0)) as "201203",
				sum(if(b.periode_date=201204,a.amount,0)) as "201204",
				sum(if(b.periode_date=201205,a.amount,0)) as "201205",
				sum(if(b.periode_date=201206,a.amount,0)) as "201206",
				sum(if(b.periode_date=201207,a.amount,0)) as "201207",
				sum(if(b.periode_date=201208,a.amount,0)) as "201208",
				sum(if(b.periode_date=201209,a.amount,0)) as "201209",
				sum(if(b.periode_date=201210,a.amount,0)) as "201210",
				sum(if(b.periode_date=201211,a.amount,0)) as "201211",
				sum(if(b.periode_date=201212,a.amount,0)) as "201212"

				from a_budget c
				inner join a_porder_detail a on a.budget_id = c.id
				inner join a_porder b on a.parent_id = b.id and b.approved_date is not null

				where c.id = '.$pid. '
					
				group by c.code, c.name'
		)->queryAll();

		$dataProvider=new CArrayDataProvider($rawData, array(
				'id'=>'id',
				'pagination'=>array(
						'pageSize'=>10,
				),
		));

		return $dataProvider;
	}

	public function perBulanModel($pid)
	{
		$rawData=Yii::app()->db->createCommand(
				'select c.name,
				sum(if(b.periode_date=201201,a.amount,0)) as "201201",
				sum(if(b.periode_date=201202,a.amount,0)) as "201202",
				sum(if(b.periode_date=201203,a.amount,0)) as "201203",
				sum(if(b.periode_date=201204,a.amount,0)) as "201204",
				sum(if(b.periode_date=201205,a.amount,0)) as "201205",
				sum(if(b.periode_date=201206,a.amount,0)) as "201206",
				sum(if(b.periode_date=201207,a.amount,0)) as "201207",
				sum(if(b.periode_date=201208,a.amount,0)) as "201208",
				sum(if(b.periode_date=201209,a.amount,0)) as "201209",
				sum(if(b.periode_date=201210,a.amount,0)) as "201210",
				sum(if(b.periode_date=201211,a.amount,0)) as "201211",
				sum(if(b.periode_date=201212,a.amount,0)) as "201212"

				from a_budget c
				inner join a_porder_detail a on a.budget_id = c.id
				inner join a_porder b on a.parent_id = b.id and b.approved_date is not null

				where c.id = '.$pid. '
					
				group by c.code, c.name'
		)->queryAll();

		foreach ($rawData as $key => $value) {
			foreach ($value as $key1 => $value1) {
				if ($key1 == 'name') {
					$rawData1[$key1]=$value1;
				} else {
					$rawData2[]=(int)$value1;
				}
			}
			$rawData3['data']=$rawData2;
			$rawDataRet[$key]=array_merge($rawData1,$rawData3);
			unset($rawData1);
			unset($rawData2);
			unset($rawData3);
		}

		if (isset($rawDataRet)) {
			return $rawDataRet;
		} else {
			return null;
		}

	}

	public function perBulanDept($id)
	{
		$rawData=Yii::app()->db->createCommand(
				'SELECT min(a.id) as id,
				b.name as department,
				sum(if(a.periode_date=201201,a.tcredit,0)) as "201201",
				sum(if(a.periode_date=201202,a.tcredit,0)) as "201202",
				sum(if(a.periode_date=201203,a.tcredit,0)) as "201203",
				sum(if(a.periode_date=201204,a.tcredit,0)) as "201204",
				sum(if(a.periode_date=201205,a.tcredit,0)) as "201205",
				sum(if(a.periode_date=201206,a.tcredit,0)) as "201206",
				sum(if(a.periode_date=201207,a.tcredit,0)) as "201207",
				sum(if(a.periode_date=201208,a.tcredit,0)) as "201208",
				sum(if(a.periode_date=201209,a.tcredit,0)) as "201209",
				sum(if(a.periode_date=201210,a.tcredit,0)) as "201210",
				sum(if(a.periode_date=201211,a.tcredit,0)) as "201211",
				sum(if(a.periode_date=201212,a.tcredit,0)) as "201212"

				FROM a_budget_department a
				INNER JOIN a_organization b ON a.department_id = b.id
				GROUP BY a.department_id, a.parent_id
				HAVING a.parent_id = '.$id
		)->queryAll();

		$dataProvider=new CArrayDataProvider($rawData, array(
				'id'=>'id',
				'pagination'=>array(
						'pageSize'=>10,
				),
		));

		return $dataProvider;
	}

	public function getCodeName() {
		$_format=$this->code .". ".$this->name;

		return $_format;
	}

	public function getRoot($id) {

		if ($id !=null) {
			$model=self::findByPk((int)$id);

			if ($model->parent_id ==300) {
				$_id = $model->department_id;
			} elseif ($model->getparent->parent_id ==300) {
				$_id = $model->getparent->department_id;
			} elseif ($model->getparent->getparent->parent_id ==300) {
				$_id = $model->getparent->getparent->department_id;
			} elseif ($model->getparent->getparent->getparent->parent_id ==300) {
				$_id = $model->getparent->getparent->getparent->department_id;
			} elseif ($model->getparent->getparent->getparent->getparent->parent_id ==300) {
				$_id = $model->getparent->getparent->getparent->getparent->department_id;
			}
		} else {
			$_id = 1; //default if empty
		}

		return $_id;
	}

	public function getTree() {
		$subitems = array();

		if($this->childs) foreach($this->childsOld as $child) {
			$subitems[] = $child->getTree();
		}

		$returnarray = array(
				'text' => CHtml::link($this->name,Yii::app()->createUrl('/aBudget/index',array('id'=>$this->id))));

		if($subitems != array())
			$returnarray = array_merge($returnarray, array('children' => $subitems));
		return $returnarray;
	}

	public function getTopTenBudgetCP() {

		$models=self::model()->with('end_balance')->findAll(array('condition'=>'t.department_id = 1 AND t.parent_id=300','limit'=>10));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->id, 'label' => $model->name.' ('.$model->end_balance->balancef().')', 'icon'=>'list-alt', 'url' => array('/m1/aBudget','id'=>$model->id));
		}

		return $returnarray;
	}


}