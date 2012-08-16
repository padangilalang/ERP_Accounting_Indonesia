<ul class="nav nav-list">
	<li class="nav-header">Favourite Menu</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				//array('label'=>'Created Last 7 days ('.aPorder::model()->getNewlyPO().')', 'url'=>array('/m1/aPorder')),
		),
)); ?>
<br />



<ul class="nav nav-list">
	<li class="nav-header">Reserved Menu #1</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				//array('label'=>'Waiting For Payment ('.aPorder::model()->getWaitingPayment().')', 'url'=>array('/m1/aApprovalForm','id'=>2)),
		),
)); ?>
<br />


<ul class="nav nav-list">
	<li class="nav-header">Reserved Menu #2</li>
</ul>
<?php //$this->widget('bootstrap.widgets.BootMenu', array(
//'type'=>'list',
//'items'=>aBudget::model()->getTopTenBudgetCP(),
//)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">Reserved Menu #3</li>
</ul>
<?php //$this->widget('bootstrap.widgets.BootMenu', array(
//'type'=>'list',
//'items'=>aBudget::model()->getTopTenBudgetCP(),
//)); ?>
<br />

