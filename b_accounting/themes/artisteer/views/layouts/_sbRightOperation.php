<ul class="nav nav-list">
	<li class="nav-header">Operation</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>$this->menu,
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">Recent Updated</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>$this->menu1,
)); ?>
<br />


<ul class="nav nav-list">
	<li class="nav-header">Recent Added</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>$this->menu2,
)); ?>
<br />


<ul class="nav nav-list">
	<li class="nav-header">Related Data</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>$this->menu3,
)); ?>
<br />

<ul class="nav nav-list">
	<li class="nav-header">Other Menu</li>
</ul>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'list',
		'items'=>$this->menu4,
)); ?>
<br />

