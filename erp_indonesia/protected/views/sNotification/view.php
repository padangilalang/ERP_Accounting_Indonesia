<?php
$this->breadcrumbs=array(
		'Notification'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('index')),
);

$this->menu1=sNotification::getTopUpdated();
$this->menu2=sNotification::getTopCreated();


?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/preferences_desktop_notification.png') ?>
		<?php echo $model->sender_ref ?>
	</h1>
</div>

<div class="row-fluid">
	<div class="span12">
		<div class="well">
			<h4><span class="icon fam-note"></span>
				<?php echo sUser::model()->findName($model->sender_id). ' to ' . sUser::model()->findName($model->receiver_id) ?>
				|
				<?php echo sParameter::item("cCategory",$model->category_id) ?>
			</h4>
			<br />
			<?php echo $model->long_desc; ?>

			<h6>
				<?php echo Yii::app()->dateFormatter->format("dd-MM-yyyy HH:mm",$model->sender_date); ?>
			</h6>

			<?php 
			$comment=sNotificationDetail::model()->findAll(array('condition'=>'parent_id = '. $model->id));
			if (isset($comment)) {
				echo "<br/>";
				$this->renderPartial('/sNotification/_comments',array(
						'comments'=>$comment,
				));
			}
			?>
		</div>

		<?php $this->renderPartial('_commentform',array(
				'model'=>$comments,
		)); ?>

	</div>

</div>



