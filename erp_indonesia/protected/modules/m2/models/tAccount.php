<?php

class tAccount extends BaseModel
{
	public $account_properties;
	public $value;
	public $text;
	public $accmain_id;
	public $haschild_id;
	public $currency_id;
	public $state_id;
	public $beginning_balance;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 't_account';
	}

	public function rules()
	{
		return array(
				array('beginning_balance', 'required','on'=>'newaccount'),
				//array('parent_id, haschild_id, account_no, account_name, currency_id, state_id', 'required'),
				array('parent_id, account_no, account_name', 'required'),
				array('parent_id, haschild_id, currency_id, state_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly'=>true),
				array('beginning_balance', 'numerical'),
				array('account_no', 'length', 'max'=>50),
				array('account_name', 'length', 'max'=>100),
				array('short_description', 'safe'),
				array('id, parent_id, haschild_id, account_no, account_name, short_description, currency_id, state_id, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'getparent' => array(self::BELONGS_TO, 'tAccount', 'parent_id'),
				'childs' => array(self::HAS_MANY, 'tAccount', 'parent_id', 'order' => 'childs.id ASC'),
				'childsCount' => array(self::STAT, 'tAccount', 'parent_id'),
				'entity' => array(self::HAS_MANY, 'tAccountEntity', 'parent_id','order'=>'entity.state_id = 1'),
				'entity_many' => array(self::MANY_MANY, 'aOrganization','t_account_entity(parent_id,entity_id)'),
				'accmain' => array(self::HAS_ONE, 'tAccountProperties', 'parent_id','condition'=>'mkey = \'accmain_id\''),
				'haschild' => array(self::HAS_ONE, 'tAccountProperties', 'parent_id','condition'=>'haschild.mkey = \'haschild_id\''),
				'currency' => array(self::HAS_ONE,'tAccountProperties','parent_id','condition'=>'currency.mvalue <>0 AND currency.mkey = \'currency_id\''),
				'state' => array(self::HAS_ONE, 'tAccountProperties', 'parent_id','condition'=>'state.mvalue <>0 AND state.mkey = \'state_id\''),
				'reverse' => array(self::HAS_ONE, 'tAccountProperties', 'parent_id','condition'=>'reverse.mvalue <>0 AND reverse.mkey= \'reverse_id\''),
				'cashbank' => array(self::HAS_ONE, 'tAccountProperties', 'parent_id','condition'=>'cashbank.mvalue <>0 AND cashbank.mkey = \'cashbank_id\''),
				'inventory' => array(self::HAS_ONE, 'tAccountProperties', 'parent_id','condition'=>'inventory.mvalue <>0 AND inventory.mkey = \'inventory_id\''),
				'hutang' => array(self::HAS_ONE, 'tAccountProperties', 'parent_id','condition'=>'hutang.mvalue <>0 AND hutang.mkey = \'hutang_id\''),

				'hasJournal' => array(self::HAS_MANY, 'uJournalDetail', 'account_no_id','with'=>'journal',
						'condition'=>'journal.yearmonth_periode = '.Yii::app()->settings->get("System", "cCurrentPeriod")),

				//'balancesheet' => array(self::HAS_ONE, 'tBalanceSheet', 'parent_id','condition'=>'yearmonth_periode = '.Yii::app()->settings->get("System", "cCurrentPeriod")),
				'balancesheet' => array(self::HAS_ONE, 'tBalanceSheet', 'parent_id'),
				//'balancesheetLast' => array(self::HAS_ONE, 'tBalanceSheet', 'parent_id','condition'=>'yearmonth_periode = '.sParameter::cBeginDateBefore(Yii::app()->settings->get("System", "cCurrentPeriod"))),
		);
	}

	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'account_no' => 'Account No',
				'account_name' => 'Account Name',
				'short_description' => 'Short Description',
				'accmain_id' => 'Main Account',
				'haschild_id' => 'Has Child',
				'currency_id' => 'Currency',
				'state_id' => 'Status',
				'created_date' => 'Created Date',
				'created_by' => 'Created',
				'updated_date' => 'Updated Date',
				'updated_by' => 'Updated',
		);
	}

	public function search($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public function searchSibling($pid,$id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$pid);
		$criteria->compare('id!',$id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public static function labarugiDitahan($periode_date)
	{
		$_grandtotal=0;
		$_grandtotalA=0;
		$_grandtotalP=0;
		$_selisih=0;

		$model1=tAccountMain::model()->with('account_list')->findAll('type_id= 1');

		foreach($model1 as $mmm) {
			foreach($mmm->account_list as $mm) {		//level1
				$model2=tAccount::model()->findByPk((int)$mm->parent_id);
				foreach($model2->childs as $model) {	//level2
					if ($model->childs) {
						foreach($model->childs as $mod) {    //level3
							$_mod=$mod->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
							if (isset($_mod->end_balance))
								$_grandtotal=$_grandtotal+$_mod->end_balance;

							if ($mod->childs) {
								foreach($mod->childs as $m) {   //level4
									$_m=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
									if (isset($_m->end_balance))
										$_grandtotal=$_grandtotal+$_m->end_balance;

									if ($m->childs) {
										foreach($m->childs as $n) {    //level5
											$_n=$n->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
											if (isset($_n->end_balance))
												$_grandtotal=$_grandtotal+$_n->end_balance;
										}
									}
								}
							}
						}
					}
				}

				if ($mmm->id ==1) {  //Aktiva
					$_grandtotalA=$_grandtotal;
				} else {
					$_grandtotalP=$_grandtotalP+$_grandtotal;
				}

				$_grandtotal=0;
			}
		}

		$_selisih=$_grandtotalA-$_grandtotalP;

		return $_selisih;
	}

	public function netprofit($periode_date)
	{
		$model1=tAccountMain::model()->with('account_list')->findAll('type_id= 2');

		$_s=5;
		//Reset
		$_total=0;
		$_subtotal=0;
		$_grandtotal=0;
		$_grandtotalI=0;
		$_grandtotalH=0;
		$_grandtotalE=0;


		foreach($model1 as $mmm) {

			foreach($mmm->account_list as $mm) {
				$model2=tAccount::model()->findByPk((int)$mm->parent_id);

				foreach($model2->childs as $model) {

					$_model=$model->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
					if (isset($_model->end_balance)){
						$_balance=number_format($_model->end_balance,0,',','.');
						$_subtotal=$_subtotal+$_model->end_balance;
						$_grandtotal=$_grandtotal+$_model->end_balance;
					} else
						$_balance=0;

					if ($model->childs) {
						foreach($model->childs as $mod) {

							$_mod=$mod->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
							if (isset($_mod->end_balance)){
								$_balance=number_format($_mod->end_balance,0,',','.');
								$_subtotal=$_subtotal+$_mod->end_balance;
								$_grandtotal=$_grandtotal+$_mod->end_balance;
							} else
								$_balance=0;


							if ($mod->childs) {
								foreach($mod->childs as $m) {
									$_m=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
									if (isset($_m->end_balance)){
										$_balance=number_format($_m->end_balance,0,',','.');
										$_total=$_total+$_m->end_balance;
										$_subtotal=$_subtotal+$_m->end_balance;
										$_grandtotal=$_grandtotal+$_m->end_balance;
									} else
										$_balance=0;
								}
							}

							if ($mod->childs) {
								$_total=0;
							}
						}
					}

					$_subtotal=0;
				}

				if ($mmm->id ==3) {  //income
					$_grandtotalI=$_grandtotal;
				} elseif ($mmm->id ==4) { //HPP
					$_grandtotalH=$_grandtotal;
					$_grossprofit=$_grandtotalI-$_grandtotalH;
				} else { //Expenses
					$_grandtotalE=$_grandtotal;
					$_netprofit=$_grossprofit-$_grandtotalE;
				}

				$_grandtotal=0;
			}
		}

		//Other Income and Other Expenses
		$model1=tAccountMain::model()->with('account_list')->findAll('type_id= 3');

		$_grandtotalOI=0;
		$_grandtotalOE=0;
		$_netprofitFinal=0;

		foreach($model1 as $mmm) {

			foreach($mmm->account_list as $mm) {
				$model2=tAccount::model()->findByPk((int)$mm->parent_id);


				foreach($model2->childs as $model) {

					$_model=$model->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
					if (isset($_model->end_balance)){
						$_balance=number_format($_model->end_balance,0,',','.');
						$_subtotal=$_subtotal+$_model->end_balance;
						$_grandtotal=$_grandtotal+$_model->end_balance;
					} else
						$_balance=0;

					if ($model->childs) {
						foreach($model->childs as $mod) {
							$_mod=$mod->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
							if (isset($_mod->end_balance)){
								if ($mod->reverse) {
									$_balanceR=-($_mod->end_balance);
								} else {
									$_balanceR=$_mod->end_balance;
								}

								$_balance=number_format($_balanceR,0,',','.');
								$_subtotal=$_subtotal+$_balanceR;
								$_grandtotal=$_grandtotal+$_balanceR;
							} else
								$_balance=0;

							if ($mod->childs) {
								foreach($mod->childs as $m) {
									$_m=$m->balancesheet(array('condition'=>'yearmonth_periode ='.$periode_date));
									if (isset($_m->end_balance)){
										if ($mod->reverse) {
											$_balanceR=-($_m->end_balance);
										} else {
											$_balanceR=$_m->end_balance;
										}

										$_balance=number_format($_balanceR,0,',','.');
										$_total=$_total+$_balanceR;
										$_subtotal=$_subtotal+$_balanceR;
										$_grandtotal=$_grandtotal+$_balanceR;
									} else
										$_balance=0;
								}
							}

							if ($mod->childs) {
								$_total=0;
							}
						}
					}
					if ($_grandtotalOI==0) {  //other Income
						$_grandtotalOI=$_subtotal;
					} else { //Expenses
						$_grandtotalOE=$_subtotal;
					}
					$_subtotal=0;
				}

				$_grandtotalOIE=$_grandtotal;
				$_grandtotal=0;
			}

			$_netprofitFinal=$_netprofit+$_grandtotalOIE;
		}

		return $_netprofitFinal;
	}



	public static function getTopCreated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'created_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->account_concat(), 'icon'=>'list-alt', 'url' => array('/m2/tAccount/view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function getTopUpdated() {

		$models=self::model()->findAll(array('limit'=>10,'order'=>'updated_date DESC'));

		$returnarray = array();

		foreach ($models as $model) {
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->account_concat(), 'icon'=>'list-alt', 'url' => array('/m2/tAccount/view','id'=>$model->id));
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
			$returnarray[] = array('id' => $model->account_name, 'label' => $model->account_concat(), 'icon'=>'list-alt', 'url' => array('/m2/tAccount/view','id'=>$model->id));
		}

		return $returnarray;
	}

	public static function item($all=null)
	{
		$_items=array();
		$criteria=new CDbCriteria;
		$criteria->with=array('haschild','entity');
		$criteria->compare('haschild.mvalue',1);
		$criteria->order='account_no';
		if (Yii::app()->user->name != "admin") {
			$criteria->addInCondition('entity.entity_id',sUser::model()->getGroupArray());
		}

		$models=self::model()->findAll($criteria);

		if ($all !=null)
			$_items[""]="ALL";

		foreach($models as $model) {
			$_desc = $model->short_description ? substr(" | " .$model->short_description,0,30) ."..." : "";
			$_items[$model->getparent->account_concat()][$model->id]=$model->account_concat() .$_desc;
		}

		return $_items;

	}

	public static function cashBankAccount($all=null)
	{
		$_items[]=array();

		$criteria=new CDbCriteria;
		$criteria->with=array('cashbank','entity');
		if (Yii::app()->user->name != "admin") {
			$criteria->addInCondition('entity.entity_id',sUser::model()->getGroupArray());
		}

		$criteria->order='account_no';

		$models=self::model()->findAll($criteria);

		if ($all =="ALL")
			$_items[0]="(ALL)";


		foreach($models as $model) {
			$_desc = $model->short_description ? substr(" | " .$model->short_description,0,30)."..." : "";
			$_items[$model->getparent->account_name][$model->id]=$model->account_no .". " . $model->account_name .$_desc;
		}

		return $_items;

	}

	public static function purchasingAccount($all=null)
	{

		$criteria=new CDbCriteria;
		$criteria->with=array('purchasing','entity');
		if (Yii::app()->user->name != "admin") {
			$criteria->addInCondition('entity.entity_id',sUser::model()->getGroupArray());
		}

		$criteria->order='account_no';

		$models=self::model()->findAll($criteria);

		if ($all =="ALL") {
			$_items[]=array();
			$_items[0]="(ALL)";
		} else
			$_items=array();


		foreach($models as $model) {
			$_desc = $model->short_description ? substr(" | " .$model->short_description,0,30)."..." : "";
			$_items[$model->id]=$model->account_no .". " . $model->account_name .$_desc;
		}

		return $_items;

	}

	public function getTree() {
		$subitems = array();

		if($this->childs) foreach($this->childs as $child) {
			$subitems[] = $child->getTree();
		}
		$returnarray = array(
				'text' => CHtml::link($this->account_name,Yii::app()->createUrl('/m2/tAccount/view',array("id"=>$this->id))));

		if($subitems != array())
			$returnarray = array_merge($returnarray, array('children' => $subitems));
		return $returnarray;
	}

	public function getSideValue() {  //For tAccount/posting
		if ($this->parent_id ==0) {
			$_id = $this->accmain->parentAccount->side_id;
		} elseif ($this->getparent->parent_id ==0) {
			$_id = $this->getparent->accmain->parentAccount->side_id;
		} elseif ($this->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->accmain->parentAccount->side_id;
		} elseif ($this->getparent->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->getparent->accmain->parentAccount->side_id;
		} elseif ($this->getparent->getparent->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->getparent->getparent->accmain->parentAccount->side_id;
		}

		return $_id;
	}

	public function getTypeValue() {  //For tAccount/posting
		if ($this->parent_id ==0) {
			$_id = $this->accmain->parentAccount->type_id;
		} elseif ($this->getparent->parent_id ==0) {
			$_id = $this->getparent->accmain->parentAccount->type_id;
		} elseif ($this->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->accmain->parentAccount->type_id;
		} elseif ($this->getparent->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->getparent->accmain->parentAccount->type_id;
		} elseif ($this->getparent->getparent->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->getparent->getparent->accmain->parentAccount->type_id;
		}

		return $_id;
	}

	public function getRoot() {
		if ($this->parent_id ==0) {
			$_id = $this->accmain->parentAccount->name;
		} elseif ($this->getparent->parent_id ==0) {
			$_id = $this->getparent->accmain->parentAccount->name;
		} elseif ($this->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->accmain->parentAccount->name;
		} elseif ($this->getparent->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->getparent->accmain->parentAccount->name;
		} elseif ($this->getparent->getparent->getparent->getparent->parent_id ==0) {
			$_id = $this->getparent->getparent->getparent->getparent->accmain->parentAccount->name;
		}

		if ($this->accmain ==null)
			$_id = $_id."*";

		return $_id;
	}

	public function getCurrency() {
		if ($this->currency !=null) {
			$_id = $this->currency->currencyName->name;
		} else {
			if ($this->parent_id ==0) {
				$_id = $this->currency->currencyName->name;
			} elseif ($this->getparent->parent_id ==0) {
				$_id = $this->getparent->currency->currencyName->name;
			} elseif ($this->getparent->getparent->parent_id ==0) {
				$_id = $this->getparent->getparent->currency->currencyName->name;
			} elseif ($this->getparent->getparent->getparent->parent_id ==0) {
				$_id = $this->getparent->getparent->getparent->currency->currencyName->name;
			} elseif ($this->getparent->getparent->getparent->getparent->parent_id ==0) {
				$_id = $this->getparent->getparent->getparent->getparent->currency->currencyName->name;
			}

			$_id = $_id."*";
		}


		return $_id;
	}

	public function getState() {
		if ($this->state !=null) {
			$_id = $this->state->stateName->name;
		} else {
			if ($this->parent_id ==0) {
				$_id = $this->state->stateName->name;
			} elseif ($this->getparent->parent_id ==0) {
				$_id = $this->getparent->state->stateName->name;
			} elseif ($this->getparent->getparent->parent_id ==0) {
				$_id = $this->getparent->getparent->state->stateName->name;
			} elseif ($this->getparent->getparent->getparent->parent_id ==0) {
				$_id = $this->getparent->getparent->getparent->state->stateName->name;
			} elseif ($this->getparent->getparent->getparent->getparent->parent_id ==0) {
				$_id = $this->getparent->getparent->getparent->getparent->state->stateName->name;
			}

			$_id = $_id."*";
		}

		return $_id;
	}

	public function account_concat() {
		$_concat=$this->account_no . ". " .$this->account_name;

		return $_concat;

	}

	public function entityList() {
		$list=array();
		foreach($this->entity_many as $l)
			$list[]=$l->branch_code;
			
		$_imList=implode(", ",$list);

		return $_imList;

	}

	public static function accountDetail()
	{
		$_items=array();

		$_items[""]="ALL";

		$models=self::model()->findAll(array('condition'=>'parent_id <> 0','order'=>'account_no'));
		foreach($models as $model) {
			if (!$model->childs)
				$_items[$model->getparent->account_name][$model->id]=$model->account_no." ".$model->account_name;
		}

		return $_items;
	}

	protected function afterDelete()
	{
		tAccountProperties::model()->deleteAll('parent_id ='.$this->id);

		$log=new zArLog;
		$log->description=  'User ' . Yii::app()->user->Name . ' deleted '
		. get_class($this->Owner)
		. '[' . $this->account_no. ' '.$this->account_name.'].';
		$log->action=       'DELETE';
		$log->model=        get_class($this->Owner);
		$log->idModel=      $this->Owner->getPrimaryKey();
		$log->field=        '';
		$log->creationdate= new CDbExpression('NOW()');
		$log->userid=       Yii::app()->user->id;
		$log->save();

		return true;
	}

}