<?php
session_start();
?>

<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>PlotPal</title>
	
	
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/main.css">
	
	<script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/custom.modernizr.js"></script>

</head>
<body>

<nav class="top-bar">
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">PlotPal</a></h1>
		</li>
	</ul>
	
	<section class="top-bar-section">
		<ul class="right">
			<?php if(isset($_SESSION['user'])) { ?>
				<li><a href="#">Submit Synopsis</a></li>
				<li><a id="logout" class="small button">Logout</a></li>
			<?php } ?>
			<?php if(!isset($_SESSION['user'])) { ?>
				<li><a id="login" class="small button">Login</a></li>
			<?php } ?>
		</ul>
	</section>
</nav>