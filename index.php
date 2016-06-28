
<!--		Language switch handle		-->
	<?php
	session_start();
	header('Cache-control: private'); // IE 6 FIX 
	if(isSet($_GET['lang']))
	{
	$lang = $_GET['lang'];
	 
	// register the session and set the cookie
	$_SESSION['lang'] = $lang;
	 
	setcookie('lang', $lang, time() + (3600 * 24 * 30));
	}
	else if(isSet($_SESSION['lang']))
	{
	$lang = $_SESSION['lang'];
	}
	else if(isSet($_COOKIE['lang']))
	{
	$lang = $_COOKIE['lang'];
	}
	else
	{
	$lang = 'en';
	}

	switch ($lang) {
	  case 'en':
	  $lang_file = "lang.en.php";
	  break;
	 
	  case 'fr':
	  $lang_file = "lang.fr.php";
	  break;
	 
	  default:
	  $lang_file = "lang.fr.php";
	 
	}

	include_once($_SERVER["DOCUMENT_ROOT"]."/languages/".$lang_file);
	?>
<!--	end Language switch handle		-->


<!DOCTYPE html>
<html lang=<?php $lang?>>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="Viewport" content="width = device-width, initial-scale = 1">
<head>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Calligraffitti" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<title>Manatea Bresson</title>
</head>
<body>




<!--============FRONT END============-->

	<!--============Carousel============-->
		<div id="theCarousel" class="carousel slide md" data-ride="carousel">
		<!-- Define how many slides to put in the carousel -->
		<ol class="carousel-indicators">
		<li data-target="#theCarousel" data-slide-to="0" class="active"> </li >
		<li data-target="#theCarousel" data-slide-to="1"> </li>
		<li data-target ="#theCarousel" data-slide-to="2"> </li>
		</ol >
		<!-- Define how many slides to put in the carousel -->
		<!-- Define the text to place over the image -->
		<div class="carousel-inner">
		<div class="item active" >
			<div class ="slide1"></div>
			<div class="carousel-caption"></div>
		</div>
		<div class="item">
			<div class="slide2"></div>
			<div class="carousel-caption"></div>
		</div>
		<div class="item">
			<div class="slide3"></div>
			<div class="carousel-caption"></div>
		</div>
		</div>
		<!-- Set the actions to take when the arrows are clicked -->
		<a class="left carousel-control" href="#theCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#theCarousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
		</a>	
		</div>
	<!--========end Carousel============-->

	<!--============Title============-->
		<div class="title name">
		<h4>Manatea Bresson</h4>
		<img src="media/photo/bac.png" class="img-circle hidden-xs" alt="Cinque Terre" width="120" height="120">
		</div>

		<div class="title text-center">
		<div class="main-text">
		<div class="col-md-12">
		<h1><?php echo $lang['PAGE_TITLE']?></h1>
		</div>
		</div>
	<!--============Button Group============-->
		<div id="btn-bar" class="btn-group">
		<a href="mailto:manatea.b@gmail.com?Subject=Mail from website" target="_top" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span></a>
		<a href=<?php echo $lang['RESUME_LINK'];?> type="button" class="btn btn-primary"><?php echo $lang['MENU_ABOUT_US']?></a>
		<a href="https://www.linkedin.com/in/manateabresson" type="button" class="btn btn-primary">LinkedIn</a>
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><?php echo $lang['PROJECT'] ?>
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
			    <li><a href="/project/TP2/CandyPop.xhtml">Candy game</a></li>
			    <li><a href="/project/calendar/accueil.php"><?php echo $lang['CALENDAR']." (".$lang['ONPROGRESS'].")" ?></a></li>
			    <li><a href="/project/TP3/accueil.php"><?php echo $lang['DOODLE']." (".$lang['ONPROGRESS'].")" ?></a></li>
			</ul>
		</div>
		</div>
		</div>
	<!--========end Button Group============-->
	<!--========end Title============-->

	<!--============Language switch button============-->
		
		</p><div class="text text-center"><a class='button' type='button' href=<?php echo $lang['LANG_LINK'];?>><?php echo $lang['LANG'];?></a>
		</div>
	<!--========end Language switch button============-->

	<!--============Quote============-->
		</p><div class="container text text-center quote">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"></div>
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 well well-sm"><?php echo $lang['SLOGAN']?></div>
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"></div>
		</div>	
		</div>
	<!--========end Quote============-->

<!--        	end FRONT END        	-->



<!--  		Script pour Jquery et Bootstrap.js  	-->
	<div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
	</div>
<!--  	end Script pour Jquery et Bootstrap.js  	-->

</body>
</html>