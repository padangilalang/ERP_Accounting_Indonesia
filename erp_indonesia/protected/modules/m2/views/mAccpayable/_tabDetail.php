
<?php 
//$this->widget('bootstrap.widgets.BootDetailView', array(
$this->widget('ext.XDetailView', array(
		'ItemColumns' => 2,
		'data'=>$model,
		'attributes'=>array(
				'company_name',
				'pic',
				'address',
				'address1',
				'address2',
				'address3',
				'city',
				'pos_code',
				'province',
				'telephone',
				'fax',
				'email',
				'method_id',
				'bank_id',
				'no_account',
				'atas_nama',
				array(
						'label'=>'Status',
						'value'=>$model->status->name,
				),
		),
)); ?>
