<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="description" content="Description" />
<meta name="keywords" content="Keywords" />

</head>
<style>
	body {
		padding-top: 50px; /* 60px to make the container go all the way to the bottom of the topbar */
	}

	@media (max-width: 980px) {
		body{
			padding-top: 0px;
		}
	}
</style>

<body>

<?php echo $content; ?>
				
</body>
</html>


