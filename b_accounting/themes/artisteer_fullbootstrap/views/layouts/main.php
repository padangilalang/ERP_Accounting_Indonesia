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

<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css"
	type="text/css" media="screen" />

</head>

<body>

	<?php $this->beginContent('/layouts/_bootNavBar'); $this->endContent(); ?>

	<div class="container">
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


	</div>
	<!-- /container -->

	<?php $this->beginContent('/layouts/_footer'); $this->endContent(); ?>

</body>
</html>
