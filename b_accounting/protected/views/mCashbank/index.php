<?php
$this->breadcrumbs=array(
		'Cash and Bank',
);

$this->menu=array(
		array('label'=>'Home', 'url'=>array('/mCashbank')),
		array('label'=>'Create', 'url'=>array('create')),
);


$this->menu1=uJournal::getTopUpdated(2);
$this->menu2=uJournal::getTopCreated(2);


Yii::app()->clientScript->registerScript('search', "
		$('.anyobjectR view-right').submit(function(){
		$.fn.yiiListView.update('journallist', {
		data: $(this).serialize()
});
		return false;
});
		");


?>

<div class="pull-right">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
	)); ?>
</div>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/bank.png') ?>
		Cash and Bank
	</h1>
</div>


<?php
$this->widget('DropDownRedirect', array(
		'data' => tAccount::cashBankAccount("ALL"),
		'url' => $this->createUrl($this->route, array_merge($_GET, array('pid' => '__value__'))),
		'select' =>(isset($_GET['pid'])) ? $_GET['pid'] : "(ALL)",
));
?>

<?php 
if (isset($_GET['pid'])) {
	if ((int)$_GET['pid'] !=0) {
		echo "<b><p style='display: block;margin: 5px 0;padding: 2px;background-color: yellow;'>";
		echo "Filter By: " . tAccount::model()->findByPk((int)$_GET['pid'])->account_name;
		echo "</p></b>";
	}
}
?>

<div id="posts">
<?php foreach($dataProvider as $data): ?>
    <div class="post">
		<?php echo $this->renderPartial('/uJournal/_view', array('data'=>$data)); ?>
    </div>
<?php endforeach; ?>
</div>

<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#posts',
    'itemSelector' => 'div.post',
    'loadingText' => 'Loading...',
    'donetext' => 'This is the end... ',
    'pages' => $pages,
)); ?>