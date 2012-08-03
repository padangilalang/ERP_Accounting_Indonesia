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

