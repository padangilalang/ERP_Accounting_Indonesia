<?php
$this->breadcrumbs=array(
		'Organization Structure',
);

$this->menu=array(
		array('label'=>'Create', 'url'=>array('create')),
);

$this->menu1=aOrganization::getTopUpdated();
$this->menu2=aOrganization::getTopCreated();


?>

<div class="pull-right">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
	)); ?>
</div>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/document_organization_chart_01.png') ?>
		Organization Structure
	</h1>
</div>


<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
)); ?>
