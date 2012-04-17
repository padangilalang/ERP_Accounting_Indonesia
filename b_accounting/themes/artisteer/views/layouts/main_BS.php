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

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="images/apple-touch-icon-114x114.png">
</head>

<body>

	<?php $this->beginContent('/layouts/_menu'); $this->endContent(); ?>

	<div class="container">
		<?php $this->beginContent('/layouts/_header'); $this->endContent(); ?>
		<?php $this->beginContent('/layouts/_navigation'); $this->endContent(); ?>
		<?php $this->beginContent('/layouts/_notification'); $this->endContent(); ?>

		<div class="row">
			<div class="span10">
				<?php echo $content ?>
			</div>
			<div class="span2">
				<?php $this->beginContent('/layouts/_sbRightMenu'); $this->endContent(); ?>
			</div>
		</div>
		<?php $this->beginContent('/layouts/_footer'); $this->endContent(); ?>

	</div>
	<!-- /container -->
</body>
</html>
