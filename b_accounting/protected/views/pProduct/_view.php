	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('no_polisi')); ?>:</b>
	<?php echo CHtml::encode($data->no_polisi); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('warna')); ?>:</b>
	<?php echo CHtml::encode($data->warna); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('no_bpkb')); ?>:</b>
	<?php echo CHtml::encode($data->no_bpkb); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('stnk_berlaku_sd')); ?>:</b>
	<?php echo CHtml::encode($data->stnk_berlaku_sd); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('no_mesin')); ?>:</b>
	<?php echo CHtml::encode($data->no_mesin); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('no_rangka')); ?>:</b>
	<?php echo CHtml::encode($data->no_rangka); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
<?php echo CHtml::encode($data->created_date); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('created_id')); ?>:</b>
<?php echo CHtml::encode($data->created_id); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('updated_date')); ?>:</b>
<?php echo CHtml::encode($data->updated_date); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('updated_id')); ?>:</b>
<?php echo CHtml::encode($data->updated_id); ?>
<br />

*/ ?>
