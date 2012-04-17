<?php
Yii::app()->clientScript->registerScript('search'.$data->id, "
		$('.hide-info'+$data->id).click(function(){
		$('.list'+$data->id).toggle();
		return false;
});
		");
?>

<p>

	<b><?php 
	if ($data->parent_id == 0) {
		echo CHtml::link($data->account_no .". ". $data->account_name, array('view', 'id'=>$data->id));
	} elseif ($data->getparent->parent_id == 0) {
		echo "--- ". CHtml::link($data->account_concat(), array('view', 'id'=>$data->id));
	} elseif ($data->getparent->getparent->parent_id == 0) {
		echo "------ ".CHtml::link($data->account_concat(), array('view', 'id'=>$data->id));
	} elseif ($data->getparent->getparent->getparent->parent_id == 0) {
		echo "--------- ".CHtml::link($data->account_concat(), array('view', 'id'=>$data->id));
	} elseif ($data->getparent->getparent->getparent->getparent->parent_id == 0) {
		echo "------------ ".CHtml::link($data->account_concat(), array('view', 'id'=>$data->id));
	} elseif ($data->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
		echo "--------------- ".CHtml::link($data->account_concat(), array('view', 'id'=>$data->id));
	} else {
		echo "------------------ ".CHtml::link($data->account_concat(), array('view', 'id'=>$data->id));

	}

	?> </b>

	<?php /*
	<?php echo CHtml::link('>>>','#',array('class'=>'hide-info'.$data->id)); ?>

	<div class="list<?php echo $data->id ?>" style="display:none">

	<table>
	<tr>
	<td><?php if ($data->short_description !=null)  echo CHtml::encode($data->short_description); ?></td>
	<td>.</td>
	</tr>
	<tr>
	<td><?php echo "Type Account"; ?></td>
	<td><b><?php echo $data->getRoot(); ?></b></td>
	</tr>
	<tr>
	<td><?php echo "Currency"; ?></td>
	<td><b><?php echo $data->getCurrency(); ?></b></td>
	</tr>
	<tr>
	<td><?php echo "Status"; ?></td>
	<td><b><?php echo $data->getState(); ?></b></td>
	</tr>
	</table>
	<br/>
	<b>Apply to: </b>
	<?php
	foreach($data->entity_many as $many)
		echo $many->name . ", ";
	?>
	</div>

	*/ ?>

</p>
