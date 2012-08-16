<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_hriskd')); ?>:</b>
	<?php echo CHtml::encode($data->c_hriskd); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_fmjenjang')); ?>:</b>
	<?php echo CHtml::encode($data->c_fmjenjang); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('vc_fmnama')); ?>:</b>
	<?php echo CHtml::encode($data->vc_fmnama); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_fmkota')); ?>:</b>
	<?php echo CHtml::encode($data->c_fmkota); ?>
	<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_fmjurusan')); ?>:</b>
	<?php echo CHtml::encode($data->c_fmjurusan); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('n_fmlulus')); ?>:</b>
<?php echo CHtml::encode($data->n_fmlulus); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('c_rfnegara')); ?>:</b>
<?php echo CHtml::encode($data->c_rfnegara); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('c_institusi')); ?>:</b>
<?php echo CHtml::encode($data->c_institusi); ?>
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

<b><?php echo CHtml::encode($data->getAttributeLabel('pf_ipk')); ?>:</b>
<?php echo CHtml::encode($data->pf_ipk); ?>
<br />

<b><?php echo CHtml::encode($data->getAttributeLabel('t_jenis')); ?>:</b>
<?php echo CHtml::encode($data->t_jenis); ?>
<br />

*/ ?>

</div>
