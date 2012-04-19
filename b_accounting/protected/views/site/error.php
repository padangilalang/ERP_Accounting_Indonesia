<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
		'Error',
);
?>

<div class="alert alert-error">
	<h4 class="alert-heading">
		Error!
		<?php echo $code; ?>
	</h4>
	<?php echo CHtml::encode($message); ?>
</div>
