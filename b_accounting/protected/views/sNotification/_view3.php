<div class="comment">
	<div class="author">
		<b><?php echo sParameter::item("cCategory",$data->category_id); ?> </b>
	</div>

	<div class="time">
		<?php echo CHtml::encode($data->sender_date,1); ?>
	</div>

	<div class="content">
		<?php echo CHtml::encode($data->long_desc); ?>
	</div>
</div>

