
<?php echo CHtml::encode($data->message); ?>
<table>
	<tr>
		<td width=60%><br /> <?php echo CHtml::encode($data->filename); ?> <br />

			<?php echo CHtml::encode($data->cfrom); ?>
		</td>
		<td width=40%><br /> <?php echo CHtml::encode($data->sent); ?> <br />

			<?php echo CHtml::encode($data->received); ?>
		</td>
	</tr>
</table>
