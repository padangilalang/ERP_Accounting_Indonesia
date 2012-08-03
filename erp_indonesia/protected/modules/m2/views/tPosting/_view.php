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


<div id="list-<?php echo $data->id; ?>" class="well">

	<b><?php 
	echo CHtml::encode($data->system_ref);
	if ($data->state_id != 1) echo " (" .sParameter::item("cStatus",$data->state_id) .")";
	?> </b>

	<?php echo CHtml::link('detail<i class="icon-chevron-right"></i>','#',array('class'=>'hide-info'.$data->id)); ?>

	<br />
	<br />
	<div class="list<?php echo $data->id ?>" style="display: none">
	
		<?php
			//$this->widget('bootstrap.widgets.BootDetailView', array(
			$this->widget('ext.XDetailView', array(
				'ItemColumns' => 2,
				'data'=>array(
						'id'=>1, 
						'module_id'=>$data->module->name,
						'input_date'=>$data->input_date,
						'yearmonth_periode'=>$data->yearmonth_periode,
						'user_ref'=>$data->user_ref,
						'entity_id'=>$data->entity->name,
						'remark'=>$data->remark,
				),
				'attributes'=>array(
						array('name'=>'module_id', 'label'=>'Module'),
						array('name'=>'input_date', 'label'=>'Input Date'),
						array('name'=>'yearmonth_periode', 'label'=>'Periode'),
						array('name'=>'user_ref', 'label'=>'User Ref'),
						array('name'=>'entity_id', 'label'=>'Entity'),
						array('name'=>'remark', 'label'=>'Remark'),
				),
		)); ?>
	
	
	</div>

	<?php echo $this->renderPartial('_viewDetail', array('id'=>$data->id,'data'=>$data)); ?>
</div>

