<?php $this->beginContent('/layouts/mainFixed'); ?>

				<?php //$this->beginContent('/layouts/_header'); $this->endContent(); ?>
				<?php //$this->beginContent('/layouts/_navigation'); $this->endContent(); ?>
				<div class="cleared reset-box"></div>
				<?php $this->beginContent('/layouts/_notification'); $this->endContent(); ?>

				<div class="cleared reset-box"></div>


				<div class="art-content-layout">
						<div class="art-layout-cell art-sidebar1">
							<?php $this->beginContent('/layouts/_sbLeftMenu'); $this->endContent(); ?>
						</div>
						
						<div class="art-post">
									<?php echo $content; ?>
						</div>
						
						<div class="art-layout-cell art-sidebar2">
							<?php $this->beginContent('/layouts/_sbRightOperation'); $this->endContent(); ?>
						</div>

				</div>

<?php $this->endContent(); ?>
