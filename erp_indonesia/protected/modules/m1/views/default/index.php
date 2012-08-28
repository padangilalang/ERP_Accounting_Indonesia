<?php  
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/peter_custom.css');

?>

<?php
$this->breadcrumbs=array(
		$this->module->id,
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/company.png') ?>
		Welcome!! (SAMPLE PAGE)
	</h1>
</div>

<div class="row">
	<div class="span10">
		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-inbox.png"
				alt="Inbox" /> </a>
			<div class="dashIconText ">
				<a href="#">Inbox</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-shopping-cart2.png"
				alt="Order History" /> </a>
			<div class="dashIconText">
				<a href="#">Order History</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-cash2.png"
				alt="Manage Prices" /> </a>
			<div class="dashIconText">
				<a href="#">Manage Prices</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-people.png"
				alt="Customers" /> </a>
			<div class="dashIconText">
				<a href="#">Customers</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-chart.png"
				alt="Page" /> </a>
			<div class="dashIconText">
				<a href="#">Reports</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-barcode.png"
				alt="Products" /> </a>
			<div class="dashIconText">
				<a href="#">Products</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-address-book.png"
				alt="Contacts" /> </a>
			<div class="dashIconText">
				<a href="#">Contacts</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-calendar.png"
				alt="Calendar" /> </a>
			<div class="dashIconText">
				<a href="#">Calendar</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-recycle-bin.png"
				alt="Trash" /> </a>
			<div class="dashIconText">
				<a href="#">Trash</a>
			</div>
		</div>

		<div class="dashIcon span2">
			<a href="#"><img
				src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/icon-warning.png"
				alt="System Alerts" /> </a>
			<div class="dashIconText">
				<a href="#">System Alerts</a>
			</div>
		</div>


	</div>
</div>
<!-- END OF .dashIcons -->
