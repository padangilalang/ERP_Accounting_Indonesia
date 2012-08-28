<ul class="nav nav-list">
	<li class="nav-header">Purchase Order</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				array('label'=>'Created Last 7 days ','count'=>aPorder::model()->getNewlyPO(), 'icon'=>'list-alt', 'url'=>array('/m1/aPorder')),

		),
)); ?>
<br />



<ul class="nav nav-list">
	<li class="nav-header">Approval Form</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>array(
				//array('label'=>'Waiting For Approval <span class="badge badge-info">'.aPorder::model()->getWaitingApproval().'</span>', 'url'=>array('/m1/aApprovalForm')),
				array('label'=>'Waiting For Approval', 'count'=> aPorder::model()->getWaitingApproval(), 'icon'=>'list-alt', 'url'=>array('/m1/aApprovalForm')),
				array('label'=>'Waiting For Payment','count'=>aPorder::model()->getWaitingPayment(), 'icon'=>'list-alt', 'url'=>array('/m1/aApprovalForm','id'=>2)),
		),
)); ?>
<br />


<ul class="nav nav-list">
	<li class="nav-header">Top Budget Realization (CP)</li>
</ul>
<?php //$this->widget('bootstrap.widgets.BootMenu', array(
//'type'=>'list',
//'items'=>aBudget::model()->getTopTenBudgetCP(),
//)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">Leave Approval</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>gPerson::model()->listWaitingApproval(),
)); ?>
<br />
