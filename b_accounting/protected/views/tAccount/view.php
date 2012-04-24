<?php
if (isset($model->getparent->getparent->getparent->account_name)) {
	$this->breadcrumbs=array(
			$model->getparent->getparent->getparent->account_name=>array('view','id'=>$model->getparent->getparent->getparent->id),
			$model->getparent->getparent->account_name=>array('view','id'=>$model->getparent->getparent->id),
			$model->getparent->account_name=>array('view','id'=>$model->getparent->id),
			$model->account_name,
	);

} elseif (isset($model->getparent->getparent->account_name)) {
	$this->breadcrumbs=array(
			$model->getparent->getparent->account_name=>array('view','id'=>$model->getparent->getparent->id),
			$model->getparent->account_name=>array('view','id'=>$model->getparent->id),
			$model->account_name,
	);

} elseif (isset($model->getparent->account_name)) {
	$this->breadcrumbs=array(
			$model->getparent->account_name=>array('view','id'=>$model->getparent->id),
			$model->account_name,
	);
} else {
	$this->breadcrumbs=array(
			$model->account_name,
	);
}


$this->menu=array(
		array('label'=>'Home', 'url'=>array('index')),
		//array('label'=>'Create', 'url'=>array('create')),
		array('label'=>'Update', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
				'visible'=>empty($model->hasJournal)),
);

$this->menu1=tAccount::getTopUpdated();
$this->menu2=tAccount::getTopCreated();
$this->menu3=tAccount::getTopRelated($model->account_name);

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/tree_diagramm_new.png') ?>
		<?php echo $model->account_no .". ".$model->account_name; ?>
	</h1>
</div>

<?php
if ($model->haschild->mvalue == 2) {
	$this->widget('bootstrap.widgets.BootTabbable', array(
			'type'=>'tabs', // 'tabs' or 'pills'
			'tabs'=>array(
					array('label'=>'Detail','content'=>$this->renderPartial("_tabDetail", array("model"=>$model,"modelAccount"=>$modelAccount), true)),
					array('label'=>'Entity','content'=>$this->renderPartial("_tabEntity", array("model"=>$model,'modelEntity'=>$modelEntity), true)),
					array('label'=>'Sub Account','content'=>$this->renderPartial("_tabSub", array("model"=>$model), true)),
					array('label'=>'Linked Module','content'=>$this->renderPartial("_tabModule", array("model"=>$model), true)),
			),
	));
} else {
	$this->widget('bootstrap.widgets.BootTabbable', array(
			'type'=>'tabs', // 'tabs' or 'pills'
			'tabs'=>array(
					//array('label'=>'Balance','content'=>$this->renderPartial("_tabBalance", array("model"=>$model,"modelAccount"=>$modelAccount,"pages"=>$pages), true)),
					array('label'=>'Balance','content'=>$this->renderPartial("_tabBalance", array("model"=>$model,"modelAccount"=>$modelAccount), true)),
					array('label'=>'Detail','content'=>$this->renderPartial("_tabDetail", array("model"=>$model,"modelAccount"=>$modelAccount), true)),
					array('label'=>'Entity','content'=>$this->renderPartial("_tabEntity", array("model"=>$model,'modelEntity'=>$modelEntity), true)),
					array('label'=>'Sub Account','content'=>$this->renderPartial("_tabSub", array("model"=>$model), true)),
					array('label'=>'Linked Module','content'=>$this->renderPartial("_tabModule", array("model"=>$model), true)),
			),
	));
}

?>
