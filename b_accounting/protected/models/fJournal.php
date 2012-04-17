<?php
class fJournal extends CFormModel
{

	public $input_date;
	public $yearmonth_periode;
	public $cb_receiver;
	public $cb_received_from;
	public $user_ref;
	public $system_ref;
	public $remark;

	public $journal_type_id;
	public $state_id;
	public $parent_id;
	public $account_no_id;
	public $sub_account_id;
	public $debit;
	public $credit;
	public $user_remark;
	public $system_remark;

	public $master_id;

	public $debitceknumber;
	public $creditceknumber;

	public $balance;

	public $var_account;


	public function attributeLabels()
	{
		return array(
				'input_date'=>'Input Date',
				'yearmonth_periode'=>'Periode',
				'user_ref'=>'User Ref',
				'cb_receiver'=>'Receiver',
				'cb_received_from'=>'Received From',
				'system_ref'=>'System Ref',
				'remark'=>'Remark',
				'balance'=>'Balance',
				'var_account'=>'Source Account',
				'sub_account_id'=>'Linked Transaction',
		);
	}

	public function rules()
	{
		return array(
				array('input_date, account_no_id, debit, credit', 'required'),
				array('field','multiItemRequired','compare'=>'cb_receiver,cb_received_from','on'=>'cashbank'),
				array('input_date', 'type', 'type'=>'date', 'dateFormat'=>'dd-MM-yyyy'),
				array('balance', 'boolean','allowEmpty'=>false,'strict'=>true,'trueValue'=>"OK",'message'=>'Journal is not Balance'),
				array('cb_receiver,cb_received_from','safe'),
					
		);
	}

	public function multiItemRequired($attribute,$params)
	{
		if(empty($this->$attribute))
		{
			$required = false;
			$item = explode(',',$params['compare']);
			foreach($item as $attr)
			{
				if(($value = trim($this->$attr)) && !empty($value))
				{
					$required = true;
					//break;
				}
			}
			if($required === false)
			{
				$field = end($item);
				$this->addError($field,Yii::t('core','Receiver or Received From cannot be blank..'));
			}
		}
		else
			return;
	}
}
