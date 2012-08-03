<div class="row-fluid">
	<div class="span9">
		<?php echo CHtml::encode($data->c_hriskd); ?>
		<?php //echo CHtml::encode($data->c_proyek); ?>
		<?php //echo CHtml::encode($data->c_pt); ?>
		<?php //echo CHtml::encode($data->c_direktorat); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_pskode')); ?>:</b>
		<?php echo CHtml::encode($data->c_pskode); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('vc_pstemlhr')); ?>:</b>
		<?php echo CHtml::encode($data->vc_pstemlhr); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('d_pstgllhr')); ?>:</b>
		<?php echo CHtml::encode($data->d_pstgllhr); ?>
		<br/>
		<b><?php echo CHtml::encode($data->getAttributeLabel('b_psjkel')); ?>:</b>
		<?php echo isset($data->sex) ? $data->sex->name : ""; ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_rfagama')); ?>:</b>
		<?php echo CHtml::encode($data->c_rfagama); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_psstskw')); ?>:</b>
		<?php echo CHtml::encode($data->c_psstskw); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_stspjk')); ?>:</b>
		<?php echo CHtml::encode($data->c_stspjk); ?>

		<b><?php echo CHtml::encode($data->getAttributeLabel('c_rfkwarga')); ?>:</b>
		<?php echo CHtml::encode($data->c_rfkwarga); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('t_domalamat')); ?>:</b>
		<?php echo CHtml::encode($data->t_domalamat); ?>
		<?php echo CHtml::encode($data->vc_domkec); ?>
		<?php echo CHtml::encode($data->c_domcity); ?>
		<?php echo CHtml::encode($data->c_dompos); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('t_psalamat')); ?>:</b>
		<?php echo CHtml::encode($data->t_psalamat); ?>
		<?php echo CHtml::encode($data->vc_pskec); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_rfcity')); ?>:</b>
		<?php echo CHtml::encode($data->c_rfcity); ?>

		<b><?php echo CHtml::encode($data->getAttributeLabel('c_pskdpos')); ?>:</b>
		<?php echo CHtml::encode($data->c_pskdpos); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('vc_psemail')); ?>:</b>
		<?php echo CHtml::encode($data->vc_psemail); ?>
		|
		<?php echo CHtml::encode($data->vc_psemail2); ?>
		<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('c_rfdarah')); ?>:</b>
		<?php echo CHtml::encode($data->c_rfdarah); ?>

		<b><?php echo CHtml::encode($data->getAttributeLabel('vc_psnotelp')); ?>:</b>
		<?php echo CHtml::encode($data->vc_psnotelp); ?>

		<b><?php echo CHtml::encode($data->getAttributeLabel('vc_psnohp')); ?>:</b>
		<?php echo CHtml::encode($data->vc_psnohp); ?>
		|
		<?php echo CHtml::encode($data->vc_psnohp2); ?>

		<b><?php echo CHtml::encode($data->getAttributeLabel('c_psaktif')); ?>:</b>
		<?php echo CHtml::encode($data->c_psaktif); ?>

		<b><?php echo CHtml::encode($data->getAttributeLabel('c_kdaktif')); ?>:</b>
		<?php echo CHtml::encode($data->c_kdaktif); ?>

		<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
		<?php echo CHtml::encode($data->userid); ?>

		<b><?php echo CHtml::encode($data->getAttributeLabel('pt_kodept')); ?>:</b>
		<?php echo CHtml::encode($data->pt_kodept); ?>
		<br /> <br />

	</div>
	<div class="span3">
		<?php 
		if ($data->c_pathfoto == null) {
			echo CHtml::image(Yii::app()->request->baseUrl . "/images/nophoto.jpg", "No Photo", array("class"=>"span2"));
		} else {
			echo CHtml::image(Yii::app()->request->baseUrl . "/images/employee/" .$data->c_pathfoto, CHtml::encode($data->vc_psnama), array("class"=>"span2"));
		}
		?>


	</div>

</div>
