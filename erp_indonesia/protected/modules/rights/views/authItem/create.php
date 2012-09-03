<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Create :type', array(':type'=>Rights::getAuthItemTypeName($_GET['type']))),
); ?>


<div class="page-header">
	<h1>	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/users.png') ?>

	<?php echo Rights::t('core', 'Create :type', array(
		':type'=>Rights::getAuthItemTypeName($_GET['type']),
	)); ?></h1>
</div>

	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>
