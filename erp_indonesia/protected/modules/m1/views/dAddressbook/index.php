<?php
$this->breadcrumbs=array(
		'Address Book'=>array('index'),
		'Manage',
);Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('daddressbook-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
<div class="page-header">
	<h1>Address Book</h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<br />
<hr />
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<?php $this->renderPartial('_search',array(
		'model'=>$model,
)); ?>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
		'id'=>'daddressbook-grid',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'template'=>'{items}{pager}{summary}',
		'columns'=>array(
				array(
						'class'=>'BootButtonColumn',
				),
				'complete_name',
				'company_name',
				'title',
				/*		'address1',
				 'address2',
'address3', */
				'handphone',
				'email',
		),
)); ?>