<?php $this->beginContent('/layouts/mainFixed'); ?>

				<div class="span10">
							<?php echo $content; ?>
				</div>

				<div class="span2 art-background">
							<?php $this->beginContent('/layouts/_sbRightOperation'); $this->endContent(); ?>
				</div>
				
<?php $this->endContent(); ?>
