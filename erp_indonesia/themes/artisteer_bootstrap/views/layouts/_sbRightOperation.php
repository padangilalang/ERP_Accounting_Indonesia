<?php if (!empty($this->menu5)): ?>	

<br/>
<ul class="nav nav-list">

<?php 
 $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Create New '.$this->menu5[0],
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'large', // '', 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl($this->id.'/create'),	
)); 

?>
</ul>
<br/>

<?php endif; ?>		 

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

