<?php
$this->breadcrumbs=array(
		'SMS',
);

?>

<div class="page-header">
	<h1>SMS</h1>
</div>

<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
