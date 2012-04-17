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


	?> 
	<?php echo CHtml::link('detail<i class="icon-chevron-right"></i>','#',array('class'=>'hide-info'.$data->id));
	echo ($data->journalSum != $data->journalSumCek) ? " WARNING!!!... FAULT BY SYSTEM. JOURNAL IS NOT BALANCE, PLEASE DELETE.." : "";
	?> </b>
	<?php if ($data->remark !=null) { ?>
	<br /> <i><?php echo CHtml::encode($data->remark); ?> </i>
	<?php }; ?>

	<br /> <br />

	<?php echo CHtml::encode($data->getAttributeLabel('entity_id')); ?>
	: <b><?php echo $data->entity->name; ?> </b> |

	<?php echo CHtml::encode($data->getAttributeLabel('input_date')); ?>
	: <b><?php echo CHtml::encode($data->input_date); ?> </b> |

	<?php echo CHtml::encode($data->getAttributeLabel('yearmonth_periode')); ?>
	: <b><?php echo CHtml::encode($data->yearmonth_periode); ?> </b> |

	<?php echo "Receiver/Received From"; ?>
	: <b><?php echo CHtml::encode($data->user_ref); ?> </b> |

	<?php echo "TOTAL"; ?>
	: <b><?php echo $data->journalSumF(); ?> </b>

	<div class="list<?php echo $data->id ?>" style="display: none">
		<br />

		<?php echo $this->renderPartial('/uJournal/_viewDetail', array('id'=>$data->id)); ?>
	</div>
</div>

<hr />

