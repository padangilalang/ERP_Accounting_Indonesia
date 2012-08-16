<div class="well">
<b><?php echo CHtml::link(CHtml::encode($data->company_name),array('view','id'=>$data->id)); ?>
</b>
<br />
<br />

<?php /*
<b><?php echo CHtml::encode($data->getAttributeLabel('pic')); ?>:</b>
<?php echo CHtml::encode($data->pic); ?>
<br />
<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
<?php echo CHtml::encode($data->address); ?>
<br />
<b><?php echo CHtml::encode($data->getAttributeLabel('address1')); ?>:</b>
<?php echo CHtml::encode($data->address1); ?>
<br />
<b><?php echo CHtml::encode($data->getAttributeLabel('address2')); ?>:</b>
<?php echo CHtml::encode($data->address2); ?>
<br />
<b><?php echo CHtml::encode($data->getAttributeLabel('address3')); ?>:</b>
<?php echo CHtml::encode($data->address3); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
<?php echo CHtml::encode($data->city); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('pos_code')); ?>:</b>
<?php echo CHtml::encode($data->pos_code); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('province')); ?>:</b>
<?php echo CHtml::encode($data->province); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
<?php echo CHtml::encode($data->telephone); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
<?php echo CHtml::encode($data->fax); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
<?php echo CHtml::encode($data->email); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('method_id')); ?>:</b>
<?php echo CHtml::encode($data->method_id); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('bank_id')); ?>:</b>
<?php echo CHtml::encode($data->bank_id); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('no_account')); ?>:</b>
<?php echo CHtml::encode($data->no_account); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('atas_nama')); ?>:</b>
<?php echo CHtml::encode($data->atas_nama); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
<?php echo CHtml::encode($data->status_id); ?>
<br />

*/ 

$this->widget('BootDetailView', array(
		'data'=>array(
				'id'=>1, 
				'pic'=>$data->pic,
				'address'=>$data->address,
				'address1'=>$data->address1,
				'address2'=>$data->address2,
				'address3'=>$data->address3,
		),
		'attributes'=>array(
				array('name'=>'pic', 'label'=>'Account Type'),
				array('name'=>'address'),
				array('name'=>'address1'),
				array('name'=>'address2'),
				array('name'=>'address3'),
		),
		'cssFile' => Yii::app()->theme->baseUrl.'/css/peter_custom.css',

)); 

?>
</div>