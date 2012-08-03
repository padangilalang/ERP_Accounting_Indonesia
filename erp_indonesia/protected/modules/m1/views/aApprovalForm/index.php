<?php
$this->breadcrumbs=array(
		'Approval Form',
);$this->menu=array(
		//array('label'=>'Create', 'url'=>array('create')),
);//$this->menu1=aPorder::getTopUpdated();
//$this->menu2=aPorder::getTopCreated();?>
<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/payment.png') ?>
		Approval Form:
		<?php if ($id==1) echo "Pending"; elseif ($id==2) echo "UnPaid"; else ""; ?>
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'Waiting for Approval','url'=>Yii::app()->createUrl('/m1/aApprovalForm',array("id"=>1)),'active'=>($id==1)),
				array('label'=>'Waiting for Payment','url'=>Yii::app()->createUrl('/m1/aApprovalForm',array("id"=>2)),'active'=>($id==2)),
				array('label'=>'Paid','url'=>Yii::app()->createUrl('/m1/aApprovalForm',array("id"=>3)),'active'=>($id==3)),
				array('label'=>'Show All','url'=>Yii::app()->createUrl('/m1/aApprovalForm',array("id"=>0)),'active'=>($id==0)),
		),
));
?>
<?php
//echo CHtml::ajaxLink('Next quote', Yii::app()->createUrl('/m1/aApprovalForm',array("id"=>2)),array('update' => '#grid'));
?>

<?php
if (isset($_GET['cid'])) {
	if ($_GET['cid'] != null) {
		echo "<div style='background-color:yellow; padding:3px; margin-bottom:10px'><b>";
		echo "Current Filter : " . aBudget::model()->findByPk((int)$_GET['cid'])->name;
		echo "</b></div>";
	}
}

?>

<?php
$this->widget('DropDownRedirect', array(
		'data' => aBudget::mainComponent(),
		'url' => $this->createUrl($this->route, array_merge($_GET, array('id'=>$id,'cid' => '__value__'))),
		'select' => (isset($_GET['cid'])) ? $_GET['cid'] : "ALL",
));
?>

<div id="grid">
	<?php
	$this->renderPartial('_gridAF',array("id"=>$id,"cid"=>$cid));

	?>
</div>
