<div class="view">
	<b><?php echo sUser::model()->findByPk($data->sender_id)->username; ?>
	</b> <br /> <br />
	<?php echo CHtml::encode($data->message); ?>
	<br />
	<?php echo $data->created_date; ?>
	<br />
</div>
