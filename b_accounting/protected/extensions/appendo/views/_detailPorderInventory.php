<table class="appendo-gii" id="<?php echo $id ?>">
	<thead>
		<tr>
			<th>Item</th>
			<th>Desc</th>
			<th>Qty</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($model->item_id == null): ?>
		<tr>
			<td><?php echo CHtml::dropDownList('item_id[]','',pProduct::items()); ?>
				<?php /*
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'name'=>'item_id[]',
						'source'=>array('ac1', 'ac2', 'ac3'),
						'options'=>array(
								'minLength'=>'2',
						),
				)); */
?></td>
			<td><?php echo CHtml::textField('description[]','',array()); ?></td>
			<td><?php echo CHtml::textField('qty[]','',array('maxlength'=>15)); ?>
			</td>
			<td><?php echo CHtml::textField('amount[]','',array('maxlength'=>15)); ?>
			</td>
		</tr>
		<?php else: ?>
		<?php for($i = 0; $i < sizeof($model->item_id); ++$i): ?>
		<tr>
			<td><?php echo CHtml::dropDownList('item_id[]',$model->item_id[$i],pProduct::items()); ?>
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
