<table class="appendo-gii" id="<?php echo $id ?>">
	<thead>
		<tr>
			<th>Properties</th>
			<th>Value</th>
			<th>Text</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($model->account_properties == null): ?>
		<tr>
			<td><?php echo CHtml::dropDownList('account_properties[]',"",sParameter::itemsOther("cAccProperties")); ?>
			</td>
			<td><?php echo CHtml::dropDownList('value[]','',array('0'=>'*Inherited*','1'=>'Set Yes ( or Set No Child)','2'=>'Has Child')); ?></td>
			<td><?php echo CHtml::textField('text[]',''); ?></td>
		</tr>
		<?php else: ?>
		<?php for($i = 0; $i < sizeof($model->account_properties); ++$i): ?>
		<tr>
			<td><?php echo CHtml::dropDownList('account_properties[]',$model->account_properties[$i],sParameter::itemsOther("cAccProperties")); ?>
			</td>
			<td><?php echo CHtml::dropDownList('value[]',$model->value[$i],array('0'=>'*Inherited*','1'=>'Set Yes (or Set No Child)','2'=>'Has Child')); ?>
			</td>
			<td><?php echo CHtml::textField('text[]',$model->text[$i],array()); ?>
			</td>
		</tr>
		<?php endfor; ?>
		<?php endif; ?>
	</tbody>
</table>
