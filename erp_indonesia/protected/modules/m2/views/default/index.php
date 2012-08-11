<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/company.png') ?>
		Welcome!!
	</h1>
</div>

<div class="row-fluid">
	<div class="span5">
		<?php
			echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/accounting.jpg','image',array('style'=>'width: 100%')); 
		?>
	</div>
	<div class="span7">
		<?php $this->beginWidget('bootstrap.widgets.BootHero', array(
			//'heading'=>'Welcome!!',
		)); ?>
		 
			<p>Welcome to Accounting Module. This page has been reserved for future use. Thank you for using this product</p>
			
			<p><?php $this->widget('bootstrap.widgets.BootButton', array(
				'type'=>'primary',
				'size'=>'large',
				'label'=>'Learn more',
			)); ?></p>
		 
		<?php $this->endWidget(); ?>
	</div>
</div>	

