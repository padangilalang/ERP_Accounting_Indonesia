<?php $this->beginContent('/layouts/mainFixed'); ?>

				<div class="span12">
				<?php $this->beginContent('/layouts/_breadcrumb'); $this->endContent(); ?>
				</div>
					<div class="row">
						<div class="span2">
							<?php $this->beginContent('/layouts/_sbLeftStructure'); $this->endContent(); ?>
						</div>

						<div class="span8">
							<?php echo $content; ?>
						</div>

						
						<div class="span2 art-background">
							<?php $this->beginContent('/layouts/_sbRightOperation'); $this->endContent(); ?>
						</div>
					</div>
				
<?php $this->endContent(); ?>
