<div class="comment">
	<div class="author">
		<b><?php echo CHtml::link(sUser::model()->findName($data->sender_id). ' to ' . sUser::model()->findName($data->receiver_id), 
				array('/snotification/view', 'id'=>$data->id)); ?> </b>
	</div>

	<div class="time">
		<?php echo CHtml::encode($data->sender_date); ?>
	</div>

	<div class="content">
		<?php echo CHtml::encode($data->long_desc); ?>
	</div>

	<?php 
	$comments=SNotificationDetail::model()->findAll(array('condition'=>'parent_id = '. $data->id));
	?>

	<div class="comment1">
		<?php foreach($comments as $comment): ?>

		<div class="author">
			<b><?php echo sUser::model()->findName($comment->sender_id); ?> </b>
		</div>

		<div class="time">
			<?php echo $comment->sender_date; ?>
		</div>

		<div class="content">
			<?php echo nl2br(CHtml::encode($comment->long_desc)); ?>
		</div>

		<?php endforeach; ?>
	</div>
	<!-- comment -->

</div>

