<?php $this->beginContent('/layouts/mainFixed'); ?>


				<div class="art-content-layout">
				<?php $this->beginContent('/layouts/_breadcrumb'); $this->endContent(); ?>
						<div class="art-post">
							<?php echo $content; ?>
						</div>

						<div class="art-layout-cell art-sidebar2">
							<?php $this->beginContent('/layouts/_sbRightOperation'); $this->endContent(); ?>
						</div>
				</div>
				
<?php $this->endContent(); ?>
