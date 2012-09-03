<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Assignments')=>array('assignment/view'),
	$model->getName(),
); ?>


<div class="page-header">
	<h1><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/stock_task_assigned.png') ?>
	<?php echo Rights::t('core', 'Assignments for :username', array(
		':username'=>$model->getName()
	)); ?>
	</h1>
</div>

<div class="row-fluid">
	<div class="span6">

		<?php $this->widget('bootstrap.widgets.BootGridView', array(
			'itemsCssClass'=>'table table-striped table-bordered',
			'template'=>'{items}{pager}{summary}',
			'dataProvider'=>$dataProvider,
			'template'=>'{items}',
			'hideHeader'=>true,
			'emptyText'=>Rights::t('core', 'This user has not been assigned any items.'),
			'htmlOptions'=>array('class'=>'grid-view user-assignment-table mini'),
			'columns'=>array(
    			array(
    				'name'=>'name',
    				'header'=>Rights::t('core', 'Name'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'name-column'),
    				'value'=>'$data->getNameText()',
    			),
    			array(
    				'name'=>'type',
    				'header'=>Rights::t('core', 'Type'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'type-column'),
    				'value'=>'$data->getTypeText()',
    			),
    			array(
    				'header'=>'&nbsp;',
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'actions-column'),
    				'value'=>'$data->getRevokeAssignmentLink()',
    			),
			)
		)); ?>

	</div>

	<div class="span6">

		<h3><?php echo Rights::t('core', 'Assign item'); ?></h3>

		<?php if( $formModel!==null ): ?>


				<?php $this->renderPartial('_form', array(
					'model'=>$formModel,
					'itemnameSelectOptions'=>$assignSelectOptions,
				)); ?>


		<?php else: ?>

			<p class="info"><?php echo Rights::t('core', 'No assignments available to be assigned to this user.'); ?>

		<?php endif; ?>

	</div>

</div>
