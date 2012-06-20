
<?php if (isset($this->breadcrumbs)):?>
<?php $this->widget('ext.bootstrap.widgets.BootBreadcrumbs',array(
		'links'=>$this->breadcrumbs,
		'separator'=>'/',
)); ?>
<?php endif?>

