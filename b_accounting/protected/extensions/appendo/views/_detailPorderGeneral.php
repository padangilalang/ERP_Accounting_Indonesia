<table class="appendo-gii" id="<?php echo $id ?>">
	<thead>
		<tr>
			<th>Budget</th>
			<th>Desc</th>
			<th>Qty</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($model->budget_id == null): ?>
		<tr>
			<td><?php echo CHtml::dropDownList('budget_id[]','',tAccount::item()); ?>
			</td>
			<td><?php echo CHtml::textField('description[]','',array()); ?>
			</td>
			<td><?php echo CHtml::textField('qty[]','',array('maxlength'=>15)); ?>
			</td>
			<td><?php echo CHtml::textField('amount[]','',array('maxlength'=>15)); ?>
			</td>
		</tr>
		<?php else: ?>
		<?php for($i = 0; $i < sizeof($model->budget_id); ++$i): ?>
		<tr>
			<td><?php echo CHtml::dropDownList('budget_id[]',$model->budget_id[$i],tAccount::item()); ?>
			</td>
			<td><?php echo CHtml::textField('description[]',$model->description[$i],array()); ?>
			</td>
			<td><?php echo CHtml::textField('qty[]',$model->qty[$i],array('maxlength'=>15)); ?>
			</td>
			<td><?php echo CHtml::textField('amount[]',$model->amount[$i],array('maxlength'=>15)); ?>
			</td>
		</tr>
		<?php endfor; ?>
		<?php endif; ?>
	</tbody>
</table>
