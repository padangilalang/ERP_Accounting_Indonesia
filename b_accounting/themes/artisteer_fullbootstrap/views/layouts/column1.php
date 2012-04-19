<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>


<body>

	<?php $this->beginContent('/layouts/_bootNavBar'); $this->endContent(); ?>

	<div class="container">
		<?php $this->beginContent('/layouts/_navigation'); $this->endContent(); ?>
		<?php //$this->beginContent('/layouts/_breadcrumb'); $this->endContent(); ?>
		<?php $this->beginContent('/layouts/_notification'); $this->endContent(); ?>

		<div class="row">
			<div class="span12">
				<?php echo $content ?>
			</div>
		</div>
		<?php $this->beginContent('/layouts/_footer'); $this->endContent(); ?>
	</div>



</body>
</html>

