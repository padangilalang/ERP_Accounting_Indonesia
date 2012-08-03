<div class="row">
	<div class="span12">
		<h3>
			<?php echo CHtml::link(CHtml::encode($data->vc_psnama),array('view','id'=>$data->id)); ?>
		</h3>
	</div>
</div>

<?php echo $this->renderPartial('/gPerson/_viewDetail',array('data'=>$data)); ?>