<ul class="nav nav-list">
	<li class="nav-header">Cash and Bank</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>uJournal::getTopUpdated(2),
		'htmlOptions'=>array('style'=>'font-size:12px; '),
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">PO (Unapproved)</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>vPorder::getTopUnApprovedPO(),
		'htmlOptions'=>array('style'=>'font-size:12px; '),
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">PO (Unpaid)</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>vPorder::getTopUnPaidPO(),
		'htmlOptions'=>array('style'=>'font-size:12px; '),
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">Chart Of Account</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>tAccount::getTopUpdated(),
		'htmlOptions'=>array('style'=>'font-size:12px; '),
)); ?>
<br />
