<div class="row">
	<div class="span2">
			<strong><?php echo CHtml::link(sUser::model()->findName($data->sender_id). ' to ' . sUser::model()->findName($data->receiver_id), 
			array('/sNotification/view', 'id'=>$data->id)); ?> 
		<br/>	
		<?php echo ($data->read_id ==1 && $data->receiver_id !=0) ? 'Unread' :'' ?></strong>
	</div>

	<div class="span7">
		<div class="well">
			<?php echo strlen($data->long_desc) <= 300 ? $data->long_desc : substr($data->long_desc,0,300). "..."; ?>
			
			<h6><?php echo $data->nicetime($data->sender_date); ?></h6>
			
			<?php 
				$comment=sNotificationDetail::model()->findAll(array('condition'=>'parent_id = '. $data->id));
				
				if (isset($comment)) {
				echo "<br/>";
				$this->renderPartial('/sNotification/_comments',array(
					'comments'=>$comment,
					)); 
				}
			?>
		</div>

	</div>
</div>
