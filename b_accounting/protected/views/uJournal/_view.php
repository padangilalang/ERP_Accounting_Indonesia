<?php
Yii::app()->clientScript->registerScript('search'.$data->id, "
		$('.hide-info'+$data->id).click(function(){
		$('.list'+$data->id).toggle('slow');
		return false;
});
		");
?>

<div class="raw">

	<b><?php 
	echo CHtml::link(CHtml::encode($data->system_ref), array('view', 'id'=>$data->id));
	echo ($data->state_id == 2) ? " (UnPost)" : "";
	echo ($data->state_id == 3) ? " (Locked)" : "";
	echo " ( ";

	if ($data->state_id == 4) {
		echo $data->status->name;
	} else {
		echo 	   CHtml::link('DELETE',"#", array("submit"=>array('delete', 'id'=>$data->id), 'confirm' => 'Are you sure?'));
		echo " | ";
		echo CHtml::link('UPDATE',Yii::app()->createUrl($this->id.'/update',array("id"=>$data->id)));
	}
	echo " | ";

	echo CHtml::link('PRINT',Yii::app()->createUrl($this->id.'/print',array("id"=>$data->id)),array('target'=>'_blank'));
	echo " ) ";


	?> <?php echo CHtml::link('detail<i class="icon-chevron-right"></i>','#',array('class'=>'hide-info'.$data->id));
	echo ($data->journalSum != $data->journalSumCek) ? " WARNING!!!... FAULT BY SYSTEM. JOURNAL IS NOT BALANCE, PLEASE DELETE.." : "";
	?> </b>
	<?php if ($data->remark !=null) { ?>
	<br /> <i><?php echo CHtml::encode($data->remark); ?> </i>
	<?php }; ?>

	<br /> <br />

		<?php
			//$this->widget('bootstrap.widgets.BootDetailView', array(
			$this->widget('ext.XDetailView', array(
				'ItemColumns' => 5,
				'data'=>array(
						'id'=>1, 
						'entity_id'=>$data->entity->name,
						'input_date'=>$data->input_date,
						'yearmonth_periode'=>$data->yearmonth_periode,
						'user_ref'=>$data->user_ref,
						'total'=>$data->journalSumF(),
				),
				'attributes'=>array(
						array('name'=>'entity_id', 'label'=>'Entity'),
						array('name'=>'input_date', 'label'=>'Input Date'),
						array('name'=>'yearmonth_periode', 'label'=>'Periode'),
						array('name'=>'user_ref', 'label'=>'Receiver/Received From'),
						array('name'=>'total', 'label'=>'Total'),
				),
		)); ?>
	
	<div class="list<?php echo $data->id ?>" style="display: none">

		<?php echo $this->renderPartial('/uJournal/_viewDetail', array('id'=>$data->id)); ?>
	</div>
</div>

<hr />

