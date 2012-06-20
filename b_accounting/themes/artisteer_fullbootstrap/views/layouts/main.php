<?php $this->beginContent('/layouts/mainFixed'); ?>

				<div class="span8">
							<?php echo $content; ?>
				</div>

						<div class="span2">
							<?php $this->beginContent('/layouts/_sbRightNotification'); $this->endContent(); ?>
						</div>
						
						<div class="span2 art-background">
							<?php $this->beginContent('/layouts/_sbRightMenu'); $this->endContent(); ?>
						</div>
				
<?php $this->endContent(); ?>
