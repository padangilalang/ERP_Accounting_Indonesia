<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_hriskd')); ?>:</b>
	<?php echo CHtml::encode($data->c_hriskd); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('vc_nmfm')); ?>:</b>
	<?php echo CHtml::encode($data->vc_nmfm); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_hubfm')); ?>:</b>
	<?php echo CHtml::encode($data->c_hubfm); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('vc_hubfm')); ?>:</b>
	<?php echo CHtml::encode($data->vc_hubfm); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('d_tgllhr')); ?>:</b>
	<?php echo CHtml::encode($data->d_tgllhr); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('b_jkel')); ?>:</b>
<?php echo CHtml::encode($data->b_jkel); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('c_templhr')); ?>:</b>
<?php echo CHtml::encode($data->c_templhr); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('b_aktif')); ?>:</b>
<?php echo CHtml::encode($data->b_aktif); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('vc_ket')); ?>:</b>
<?php echo CHtml::encode($data->vc_ket); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
<?php echo CHtml::encode($data->userid); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('tglmodify')); ?>:</b>
<?php echo CHtml::encode($data->tglmodify); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('pt_kodept')); ?>:</b>
<?php echo CHtml::encode($data->pt_kodept); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('py_kodeproyek')); ?>:</b>
<?php echo CHtml::encode($data->py_kodeproyek); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('f_cover')); ?>:</b>
<?php echo CHtml::encode($data->f_cover); ?>
<br />

*/ ?>

</div>
