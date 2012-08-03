<?php
class fPorder extends CFormModel
{

	public $input_date;
	public $supplier_id;
	public $remark;

	public $parent_id;
	public $item_id;
	public $item_name;
	public $description;
	public $qty;
	public $amount;


	public function attributeLabels()
	{
		return array(
				'parent_id'=>'Parent',
				'input_date'=>'Input Date',
				'supplier_id'=>'Supplier',
				'remark'=>'Remark',
				'item_id'=>'Item',
				'description'=>'description',
				'qty'=>'Qty',
				'amount'=>'Amount',
		);
	}

	public function rules()
	{
		return array(
				array('item_id, qty, amount, input_date', 'required'),
				array('item_id, qty, amount, supplier_id', 'numerical'),
				array('description, item_name,parent_id', 'length','max'=>255),
				array('input_date', 'safe'),
					
		);
	}

}
