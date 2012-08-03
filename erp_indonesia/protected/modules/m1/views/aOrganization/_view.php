
<b><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
</b>
<br />
<?php echo CHtml::encode($data->branch_code); ?>
<br />
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
<?php echo CHtml::encode($data->address); ?>
<?php echo CHtml::encode($data->address2); ?>
<?php echo CHtml::encode($data->address3); ?>
<?php echo CHtml::encode($data->address4); ?>
<?php echo CHtml::encode($data->kabupaten_id); ?>
<?php echo CHtml::encode($data->propinsi_id); ?>
<?php echo CHtml::encode($data->pos_code); ?>
<br />

<?php echo CHtml::encode($data->phone_code_area); ?>
<?php echo CHtml::encode($data->telephone); ?>

<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
<?php echo CHtml::encode($data->fax); ?>

<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
<?php echo CHtml::encode($data->email); ?>

<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
<?php echo CHtml::encode($data->website); ?>
<br />
<br />
