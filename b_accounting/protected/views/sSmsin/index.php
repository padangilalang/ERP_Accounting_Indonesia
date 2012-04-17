<?php
$this->breadcrumbs=array(
		'SMS',
);

?>

<div class="page-header">
	<h1>SMS</h1>
</div>
<?php
$this->widget('ext.JuiButtonSet.JuiButtonSet', array(
		'items' => array(
				array(
						'label'=>'List View',
						'icon-position'=>'left',
						'url'=>array('admin'),
				),
				array(
						'label'=>'Add New',
						'icon-position'=>'left',
						'url'=>array('create'),
				),
		),
		'htmlOptions' => array('style' => 'clear: both;'),
));
?>
<br />


<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
