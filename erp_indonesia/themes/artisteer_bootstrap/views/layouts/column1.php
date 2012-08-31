<?php $this->beginContent('/layouts/mainFixed'); ?>

			<div class="art-sheet-body">
				<?php //$this->beginContent('/layouts/_header'); $this->endContent(); ?>
				<?php //$this->beginContent('/layouts/_navigation'); $this->endContent(); ?>
				<?php $this->beginContent('/layouts/_breadcrumb'); $this->endContent(); ?>
				<?php $this->beginContent('/layouts/_notification'); $this->endContent(); ?>

				<div class="art-content-layout">
							<div class="art-post">
										<?php echo $content; ?>
							</div>
				</div>
			</div>

<?php $this->endContent(); ?>
