<?php
$this->breadcrumbs=array(
		'Financial Statement'=>array('index'),
		'index',
);
?>

<div class="page-header">
	<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/report.png') ?>
	Financial Statement</h1>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(

		'id'=>'t-account-report-grid',
		'dataProvider'=>tAccountReport::model()->search(),
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}',
		'columns'=>array(
				array(
						'class'=>'CButtonColumn',
						'template'=>'{report}',
						'buttons'=>array (
								'report'=>array(
										'label'=>'<i class="icon-print"></i> Report',
										'url'=>'Yii::app()->createUrl($data->link)',
										//'imageUrl'=>Yii::app()->request->baseUrl.'/css/approve.png',
								)
						)
							
							
				),
				'title',
				'description',
		),
)); ?>

<br />

