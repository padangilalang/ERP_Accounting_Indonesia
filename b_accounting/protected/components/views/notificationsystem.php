<div class="art-block">
	<div class="art-block-body">
		<div class="art-blockheader">
			<div class="l"></div>
			<div class="r"></div>
			<h3 class="t">
				<?php echo $this->title ?>
			</h3>
		</div>
		<div class="art-blockcontent">
			<div class="art-blockcontent-tl"></div>
			<div class="art-blockcontent-tr"></div>
			<div class="art-blockcontent-bl"></div>
			<div class="art-blockcontent-br"></div>
			<div class="art-blockcontent-tc"></div>
			<div class="art-blockcontent-bc"></div>
			<div class="art-blockcontent-cl"></div>
			<div class="art-blockcontent-cr"></div>
			<div class="art-blockcontent-cc"></div>
			<div class="art-blockcontent-body">
				<div>
					<!--  <p>Lorem ipsum dolor sit amet. Nam sit amet sem. Mauris a ante.</p> -->
					<table>
						<?php foreach($this->getRecentCat() as $dataC): ?>
						<tr>
							<td colspan=2><b><?php echo SParameter::item('cCategory',$dataC->category_id) ; ?>
							</b>
							</td>
						</tr>
						<?php foreach($this->getRecentData1($dataC->category_id) as $data): ?>
						<tr>
							<td width=15%><?php echo $data->sender_date; ?>
							</td>
							<td><?php echo $data->long_desc; ?>
							</td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan=2>________</td>
						</tr>
						<?php endforeach; ?>

					</table>
				</div>
				<div class="cleared"></div>
			</div>
		</div>
		<div class="cleared"></div>
	</div>
</div>


