<?php foreach($comments as $comment): ?>
<div class="row">
	<div class="span1">
		<b><?php echo sUser::model()->findName($comment->sender_id); ?> </b>
	</div>
	<div class="span5">
		<?php echo nl2br(CHtml::encode($comment->long_desc)); ?>
		<br/>
		<h6>
			<?php echo $comment->nicetime($comment->sender_date); ?>
		</h6>
	</div>
</div>
<?php endforeach; ?>
