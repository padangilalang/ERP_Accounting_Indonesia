<?php
$this->breadcrumbs=array(
		'Cash and Bank'=>array('/mCashbank'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/mCashbank')),
);

$this->menu1=uJournal::getTopUpdated(2);
$this->menu2=uJournal::getTopCreated(2);


?>


<div class="page-header">
	<h1>Cash and Bank</h1>
</div>

<?php $this->widget('bootstrap.widgets.BootTabbable', array(
		'type'=>'tabs', // 'tabs' or 'pills'
		'tabs'=>array(
				array('label'=>'Expense', 'content'=>$this->renderPartial("_tabCreateOut", array("model"=>$model), true),'active'=>true),
				array('label'=>'Income', 'content'=>$this->renderPartial("_tabCreateIn", array("model"=>$model), true)),
		),
));



