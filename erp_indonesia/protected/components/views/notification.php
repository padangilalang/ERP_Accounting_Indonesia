<table>
	<?php foreach($this->getRecentCat() as $dataC): ?>
	<tr>
		<td colspan=2><b><?php echo SParameter::item('cCategory',$dataC->category_id) ; ?>
		</b>
		</td>
	</tr>
	<?php foreach($this->getRecentData1($dataC->category_id) as $data): ?>
	<tr>
		<td width=15%><?php echo SParameter::cDateDisplay($data->sender_date); ?>
		</td>
		<td><?php echo $data->long_desc; ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan=2>.</td>
	</tr>
	<?php endforeach; ?>

</table>
