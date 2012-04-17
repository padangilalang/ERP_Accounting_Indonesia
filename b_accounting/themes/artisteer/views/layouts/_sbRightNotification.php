<ul class="nav nav-list">
	<li class="nav-header">Cash and Bank</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>uJournal::getTopUpdated(2),
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">PO (Unapproved)</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>bPorder::getTopUnApprovedPO(),
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">PO (Unpaid)</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>bPorder::getTopUnPaidPO(),
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">Chart Of Account</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>tAccount::getTopUpdated(),
)); ?>
<br />
