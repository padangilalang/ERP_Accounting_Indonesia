<div class="view">
	<div class="view-c1">
		<?php 
		if ($data->photo_path == null) {
			echo CHtml::image(Yii::app()->request->baseUrl . "/images/asset.jpg", "No Photo", array("height"=>"90"));
		} else {
			echo CHtml::image(Yii::app()->request->baseUrl . "/images/asset/" .$data->photo, CHtml::encode($data->name), array("height"=>"90"));
		}
		?>
	</div>
	<div class="view-c2">
		<?php echo CHtml::link(CHtml::encode($data->item), array('view', 'id'=>$data->id)); ?>
		<br /> <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
		<?php echo eaAssetCategory::model()->findByPk($data->category_id)->inventory_type; ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('inventory_code')); ?>:</b>
		<?php echo CHtml::encode($data->inventory_code); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('serial_number')); ?>:</b>
		<?php echo CHtml::encode($data->serial_number); ?>
	</div>
	<div class="view-c2">
		<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
		<?php echo CHtml::encode($data->remark); ?>
		<br />
	</div>
</div>
