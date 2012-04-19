<html>
<head>
<!--
	Created by Artisteer v3.0.0.39952
	Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
	-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?>
</title>
<meta name="description" content="Description" />
<meta name="keywords" content="Keywords" />


<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css"
	type="text/css" media="screen" />

<!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

		<style type="text/css" media="screen">

			.carousel-tabs { clear: both; }
			.carousel-active-tab { color: red; }	
			.carousel-disabled,
			.mr-rotato-disabled { color: #aaa; }

			.slidewrap2 .carousel-tabs {
				padding: 0;
				margin: 1em 0;
				clear: both;
			}
			.slidewrap2 .carousel-tabs li {
			    display: inline-block; 
			    padding: 0 2px;
			}
			.slidewrap2 .carousel-tabs a {
			    background: #ddd;
			    display: inline-block;
			    height: 10px;
			    text-indent: -9999px;
			    width: 10px;
			    border-radius: 5px;
			}
			.ie .slidewrap2 .carousel-tabs li,
			.ie .slidewrap2 .carousel-tabs a { 
				display: block;
				float: left;
			}
			.slidewrap2 .carousel-tabs .carousel-active-tab a {
				background: #777;
			}

			.events {
				font: normal 11px/1.4 arial, helvetica, sans-serif;
			}

		</style>
		
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugin.js"></script>
	<script>
		$(document).ready(function() {
			$('.slidewrap').carousel({
				slider: '.slider',
				slide: '.slide',
				slideHed: '.slidehed',
				nextSlide : '.next',
				prevSlide : '.prev',
				addPagination: true,
				addNav : false
			});

			$('.slidewrap2').carousel({
				slider: '.slider',
				slide: '.slide',
				addNav: false,
				addPagination: true,
				speed: 300 // ms.
			});

			$('.slidewrap3').carousel({ 
					namespace: "mr-rotato" // Defaults to “carousel”.
				})
				.bind({
					'mr-rotato-beforemove' : function() {
						$('.events').append("<li>“beforemove” event fired.</li>");
					},
					'mr-rotato-aftermove' : function() {
						$('.events').append("<li>“aftermove” event fired.</li>");
					}
				})
				.after('<ul class="events">Events</ul>');
		});
	</script>

	
</head>

<body>
	<div id="art-page-background-glare">
		<div id="art-page-background-glare-image"></div>
	</div>


	<?php $this->beginContent('/layouts/_menu'); $this->endContent(); ?>
		<div class="container-fluid">
	<div class="row-fluid">

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
				<?php $this->beginContent('/layouts/_notification'); $this->endContent(); ?>

				<?php echo $content; ?>


			</div>
		</div>
	</div>
	</div>
	<?php $this->beginContent('/layouts/_footer'); $this->endContent(); ?>		
</body>
</html>

