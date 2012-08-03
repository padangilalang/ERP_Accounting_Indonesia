<?php if (!Yii::app()->user->isGuest) {
	?>
<div class="art-nav">
	<div class="art-nav-outer">
		<div class="art-nav-inner">

			<?php if (isset($this->breadcrumbs)):?>
			<?php $this->widget('bootstrap.widgets.BootBreadcrumbs',array(
					'links'=>$this->breadcrumbs,
					'separator'=>'/',
			)); ?>
			<?php endif?>

		</div>
	</div>
</div>


<div class="cleared reset-box"></div>
<?php
}
?>
