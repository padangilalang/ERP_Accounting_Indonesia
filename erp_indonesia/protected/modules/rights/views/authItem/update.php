<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::getAuthItemTypeNamePlural($model->type)=>Rights::getAuthItemRoute($model->type),
	$model->name,
); ?>

<div id="row-fluid">

<div class="page-header">
	<h1>	<?php //echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
	<?php echo Rights::t('core', 'Update :name', array(
		':name'=>$model->name,
		':type'=>Rights::getAuthItemTypeName($model->type),
	)); ?></h1>
</div>

	<div class="span6">
	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>
	</div>
	<div class="span6">

		<h3><?php echo Rights::t('core', 'Relations'); ?></h3>

		<?php if( $model->name!==Rights::module()->superuserName ): ?>

				<h4><?php echo Rights::t('core', 'Parents'); ?></h4>

				<?php $this->widget('bootstrap.widgets.BootGridView', array(
					'itemsCssClass'=>'table table-striped table-bordered',
					'template'=>'{items}{pager}{summary}',
					'dataProvider'=>$parentDataProvider,
					'template'=>'{items}',
					'hideHeader'=>true,
					'emptyText'=>Rights::t('core', 'This item has no parents.'),
					'htmlOptions'=>array('class'=>'grid-view parent-table mini'),
					'columns'=>array(
    					array(
    						'name'=>'name',
    						'header'=>Rights::t('core', 'Name'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'name-column'),
    						'value'=>'$data->getNameLink()',
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
    						'value'=>'',
    					),
					)
				)); ?>


				<h4><?php echo Rights::t('core', 'Children'); ?></h4>

				<?php $this->widget('bootstrap.widgets.BootGridView', array(
					'itemsCssClass'=>'table table-striped table-bordered',
					'template'=>'{items}{pager}{summary}',
					'dataProvider'=>$childDataProvider,
					'template'=>'{items}',
					'hideHeader'=>true,
					'emptyText'=>Rights::t('core', 'This item has no children.'),
					'htmlOptions'=>array('class'=>'grid-view parent-table mini'),
					'columns'=>array(
    					array(
    						'name'=>'name',
    						'header'=>Rights::t('core', 'Name'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'name-column'),
    						'value'=>'$data->getNameLink()',
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
    						'value'=>'$data->getRemoveChildLink()',
    					),
					)
				)); ?>


				<h4><?php echo Rights::t('core', 'Add Child'); ?></h4>

				<?php if( $childFormModel!==null ): ?>

					<?php $this->renderPartial('_childForm', array(
						'model'=>$childFormModel,
						'itemnameSelectOptions'=>$childSelectOptions,
					)); ?>

				<?php else: ?>

					<p class="info"><?php echo Rights::t('core', 'No children available to be added to this item.'); ?>

				<?php endif; ?>


		<?php else: ?>

			<p class="info">
				<?php echo Rights::t('core', 'No relations need to be set for the superuser role.'); ?><br />
				<?php echo Rights::t('core', 'Super users are always granted access implicitly.'); ?>
			</p>

		<?php endif; ?>

	</div>

</div>