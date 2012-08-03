<?php
$this->breadcrumbs=array(
		'Journal Voucher',
);

$this->menu=array(
		array('label'=>'Home', 'icon'=>'home','url'=>array('/m2/uJournal')),
);


$this->menu1=uJournal::getTopUpdated(1);
$this->menu2=uJournal::getTopCreated(1);
$this->menu5=array('Journal');



?>
<div class="pull-right">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
	)); ?>
</div>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Journal Voucher
	</h1>
</div>

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

