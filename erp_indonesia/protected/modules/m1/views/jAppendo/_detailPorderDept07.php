<table class="appendo-gii" id="<?php echo $id ?>">
	<thead>
		<tr>
			<th>Department</th>
			<th>Sub Component</th>
			<th>Desc</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($model->department_id == null): ?>
		<tr>
			<td><?php echo CHtml::dropDownList('department_id[]','',aOrganization::getListProject()); ?>
			</td>
			<td><?php echo CHtml::dropDownList('budget_id[]','',aBudget::nonMainComponent07()); ?>
			</td>
			<td><?php echo CHtml::textField('description[]','',array('maxlength'=>500)); ?>
			</td>
			<td><?php echo CHtml::textField('amount[]','',array('size'=>15,'maxlength'=>15)); ?>
			</td>
		</tr>
		<?php else: ?>
		<?php for($i = 0; $i < sizeof($model->department_id); ++$i): ?>
		<tr>
			<td><?php echo CHtml::dropDownList('department_id[]',$model->department_id[$i],aOrganization::getListProject()); ?>
			</td>
			<td><?php echo CHtml::dropDownList('budget_id[]',$model->budget_id[$i],aBudget::nonMainComponent07(109)); ?>
			</td>
			<td><?php echo CHtml::textField('description[]',$model->description[$i],array('maxlength'=>500)); ?>
			</td>
			<td><?php echo CHtml::textField('amount[]',$model->amount[$i],array('size'=>15,'maxlength'=>15)); ?>
			</td>
		</tr>
		<?php endfor; ?>
		<?php endif; ?>
	</tbody>
</table>
