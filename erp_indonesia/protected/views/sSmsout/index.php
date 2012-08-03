<?php
$this->breadcrumbs=array(
		'send SMS',
);?>
<div class="page-header">
	<h1>Send SMS</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$modelSmsout)); ?>
<br />
<hr />
<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
