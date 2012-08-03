<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('inventory_type')); ?>:</b>
	<?php echo CHtml::encode($data->inventory_type); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('type1_info')); ?>:</b>
	<?php echo CHtml::encode($data->type1_info); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('type2_info')); ?>:</b>
	<?php echo CHtml::encode($data->type2_info); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />
</div>
