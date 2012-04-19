
<?php if (isset($this->breadcrumbs)):?>
<?php $this->widget('ext.bootstrap.widgets.BootCrumb',array(
		'links'=>$this->breadcrumbs,
		'separator'=>'/',
)); ?>
<?php endif?>

