<?php
Yii::app()->clientScript->registerScript('search'.$data->id, "
		$('.hide-info'+$data->id).click(function(){
		$('.list'+$data->id).toggle('slow');
		return false;
});
		");
?>


<?php
Yii::app()->clientScript->registerScript('myCap'.$data->id, "

		$('#myCap'+$data->id).click(function(){
		$(this).slideUp();
		$.ajax({
		type : 'get',
		url  : $(this).attr('href'),
		data: '',
		success : function(r){
		$('#mydialog').dialog('open');
		$('#list-'+$data->id).slideUp('slow');
		setTimeout(\"$('#mydialog').dialog('close') \",1200);
}
})
		return false;
});


		");

?>


<div id="list-<?php echo $data->id; ?>" class="view-c0">

	<b><?php 
	echo CHtml::encode($data->system_ref);
	if ($data->state_id != 1) echo " (" .sParameter::item("cStatus",$data->state_id) .")";
	?> </b>

	<?php echo CHtml::link('detail>>','#',array('class'=>'hide-info'.$data->id)); ?>

	<br />
	<div class="list<?php echo $data->id ?>" style="display: none">
		<br />
		<?php echo CHtml::encode($data->getAttributeLabel('module_id')); ?>
		: <b><?php echo sParameter::item("cModule",$data->module_id); ?> </b>
		<br />

		<?php echo CHtml::encode($data->getAttributeLabel('input_date')); ?>
		: <b><?php echo CHtml::encode($data->input_date); ?> </b> |

		<?php echo CHtml::encode($data->getAttributeLabel('yearmonth_periode')); ?>
		: <b><?php echo CHtml::encode($data->yearmonth_periode); ?> </b> |

		<?php echo CHtml::encode($data->getAttributeLabel('user_ref')); ?>
		: <b><?php echo CHtml::encode($data->user_ref); ?> </b> <br />
		<?php echo CHtml::encode($data->getAttributeLabel('entity_id')); ?>
		: <b><?php echo $data->entity->name; ?> </b> |

		<?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>
		: <b><?php echo CHtml::encode($data->remark); ?> </b> <br /> <br />
	</div>

	<?php echo $this->renderPartial('_viewDetail', array('id'=>$data->id,'data'=>$data)); ?>
</div>

