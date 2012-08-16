<div class="art-block">
	<div class="art-block-tl"></div>
	<div class="art-block-tr"></div>
	<div class="art-block-bl"></div>
	<div class="art-block-br"></div>
	<div class="art-block-tc"></div>
	<div class="art-block-bc"></div>
	<div class="art-block-cl"></div>
	<div class="art-block-cr"></div>
	<div class="art-block-cc"></div>
	<div class="art-block-body">
		<div class="art-blockheader">
			<div class="l"></div>
			<div class="r"></div>
			<h3 class="t">Asset</h3>
		</div>
		<div class="art-blockcontent">
			<div class="art-blockcontent-body">

				<ul>
					<?php foreach($this->getRecentData() as $data): ?>
					<li><?php echo CHtml::link($data->item,array('eAsset/view','id'=>$data->id)) ; ?><br />
						<?php echo $data->input_date ?><br /> <?php echo $data->remark ?>

					</li>

					<?php endforeach; ?>
				</ul>

				<div class="cleared"></div>
			</div>
		</div>
		<div class="cleared"></div>
	</div>
</div>


