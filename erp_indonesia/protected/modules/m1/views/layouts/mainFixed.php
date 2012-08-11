<html>
<head>
<!--
	Created by Artisteer v3.0.0.39952
	Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
	-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="description" content="Description" />
<meta name="keywords" content="Keywords" />


<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css"
	type="text/css" media="screen" />

<!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

<script type="text/javascript"
	src="<?php echo Yii::app()->theme->baseUrl; ?>/css/script.js"></script>


</head>
<style>
body {
	padding-top: 50px;
	/* 60px to make the container go all the way to the bottom of the topbar */
}

@media ( max-width : 980px) {
	body {
		padding-top: 0px;
	}
}
</style>

<body>
	<div id="art-page-background-glare">
		<div id="art-page-background-glare-image"></div>
	</div>

	<div id="art-main">



		<?php $this->beginContent('/layouts/_bootNavBar'); $this->endContent(); ?>

		<div class="art-sheet">
			<div class="art-sheet-tl"></div>
			<div class="art-sheet-tr"></div>
			<div class="art-sheet-bl"></div>
			<div class="art-sheet-br"></div>
			<div class="art-sheet-tc"></div>
			<div class="art-sheet-bc"></div>
			<div class="art-sheet-cl"></div>
			<div class="art-sheet-cr"></div>
			<div class="art-sheet-cc"></div>
			<div class="art-sheet-body">

				<?php echo $content; ?>

			</div>
		</div>
		<?php $this->beginContent('/layouts/_footer'); $this->endContent(); ?>


	</div>
</body>
</html>


