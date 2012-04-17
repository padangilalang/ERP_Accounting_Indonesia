<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
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

<body>
	<div id="art-main">

		<?php $this->beginContent('/layouts/_menu'); $this->endContent(); ?>

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
				<?php $this->beginContent('/layouts/_header'); $this->endContent(); ?>
				<?php $this->beginContent('/layouts/_navigation'); $this->endContent(); ?>
				<?php //$this->beginContent('/layouts/_breadcrumb'); $this->endContent(); ?>
				<?php $this->beginContent('/layouts/_notification'); $this->endContent(); ?>

				<div class="art-content-layout">
							<div class="art-post">

										<?php echo $content; ?>

							</div>

				</div>
			</div>


		</div>

		<?php $this->beginContent('/layouts/_footer'); $this->endContent(); ?>

	</div>


</body>
</html>

