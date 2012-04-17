<?php
$this->breadcrumbs=array(
		'Chart of Accounts'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('index')),
);

$this->menu1=tAccount::getTopUpdated();
$this->menu2=tAccount::getTopCreated();


?>

<div class="page-header">
	<h1>Create New Root Account</h1>
</div>

<?php echo $this->renderPartial('_formroot', array('model'=>$model)); ?>