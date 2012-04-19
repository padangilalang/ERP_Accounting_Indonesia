
<?php echo CHtml::link(CHtml::encode($data->item),array('view','id'=>$data->id)); ?>
<div class="row">
	<div class="span1">.</div>
	<div class="span8">
		<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
		<?php echo CHtml::encode($data->category_id); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('brand')); ?>:</b>
		<?php echo CHtml::encode($data->brand); ?>
		<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
		<?php echo CHtml::encode($data->type); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('serial_number')); ?>:</b>
		<?php echo CHtml::encode($data->serial_number); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
		<?php echo CHtml::encode($data->remark); ?>
		<br />

		<?php /*
		<b><?php echo CHtml::encode($data->getAttributeLabel('photo_path')); ?>:</b>
<?php echo CHtml::encode($data->photo_path); ?>
<br />

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
	</div>
</div>
<br />
