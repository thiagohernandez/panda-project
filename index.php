<?php
	// Multilanguage function
	//var_dump($_GET);die;
	$language_name = "es";
	if (isset($_GET['lang'])) {
		$language_name = $_GET['lang'];
	}
	if (($language_name != "es") && ($language_name != "en")) {
		$language_name != "es";
	}
	include('./language/english.php');
	include('./language/spanish.php');
	
	// TODO: Seleccionar un idioma via URL (para que google ve todas las idiomas)
	function txt($token) {
		global $language_name;
		static $language = null;
		if (!$language) {
			if ($language_name == "es") {
				$language = new Language\Spanish;		// Spanish default at the moment
			}
			else {
				$language = new Language\English;
			}
		}
		$result = $language->get($token);
		if (!$result) {
			static $english = null;
			$english = new Language\English;
			$result = $english->get($token);
		}
		return htmlentities($result,ENT_IGNORE,"ISO-8859-1");
	}

	// Modo desarrollador
	$dev_mode = (dirname(__FILE__)=='C:\Apache24\htdocs\panda\pages\homepage');
	if (!$dev_mode && isset($_COOKIE['CAKEPHP'])) {
		//echo($_COOKIE['CAKEPHP']);
		$dev_mode = ($_COOKIE['CAKEPHP'] == '9b275cade4e90a1785e7850d5ee0556d');		// My PHP session
		if (!$dev_mode) {
			$dev_mode = ($_COOKIE['CAKEPHP'] == 'pirbvb41ns4196mhe1a33185f2');
		}
	}
	if ($dev_mode) {
		//$cookie_email = "panda22@artlum.com";
		$cookie_email = "sam1@nowhere.com";
	}
	else {
		$cookie_email = "";		// TODO: store email in cookie
	}
	//var_dump($dev_mode);die;
	
	// Sizes for responsive control
	$page_to_serve = '';
	if (isset($_SERVER['REDIRECT_QUERY_STRING'])) {
		$rdr = explode('&',$_SERVER['REDIRECT_QUERY_STRING']);
		$page_to_serve = $rdr[0];
		if ($page_to_serve == "lang=en"){
				$page_to_serve = "";
		}
	}
?>
<!doctype html>
<html class="no-js" lang="es-es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?= txt('page_title') ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  

        <link rel="icon" type="image/png" href="images/favicon.png" />


        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- CSS Files -->
        <link rel="stylesheet" href="css/plugins.css?v=2.2"/>
        <!-- Revolution Slider -->
        <link rel="stylesheet" href="css/revolutionslider/settings.css" />
        <link rel='stylesheet' href='js/revolutionslider/revolution-addons/particles/css/revolution.addon.particles.css?ver=1.0.3' type='text/css' media='all' />
        <!-- Main Styles -->
        <link rel="stylesheet" href="css/theme.css?v=2.2"/>
        <!-- Color Skins -->
        <link rel="stylesheet" href="css/skins/default.css" />
        <!-- Page Styles -->
        <link rel="stylesheet" href="content/rise-01/css/rise-01.css" />
        <!-- Font-awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <style type="text/css">
            .blurslider-gradient{background:-webkit-linear-gradient(left,#9357cc 0%,#2989d8 50%,#2cc99d 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent}.blurslider-button{background:-webkit-linear-gradient(left,#9357cc 0%,#2989d8 50%,#2cc99d 100%)}
        </style>
      	<!-- End Page Styles -->


        <link rel="stylesheet" href="css/theme.min.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<!-- <script src="js/vendor/jquery-3.3.1.min.js"></script> -->
		<script type="text/javascript" src="js/jquery.min.js"></script>

		
    </head>
	<body>

      <!-- LOADER -->
    <div class="page-loader bg-white">
        <div class="v-center t-center">
            <div class="spinner">
                <div class="spinner__item1 bg-dark"></div>
                <div class="spinner__item2 bg-dark"></div>
                <div class="spinner__item3 bg-dark"></div>
                <div class="spinner__item4 bg-dark"></div>
            </div>
        </div>
    </div>



	<?php include ("./elements/header.php"); ?>

	<?php
		if ($page_to_serve == 'porque-broker-panda') {
			include ("./porque-broker-panda.php");
		}else if ($page_to_serve == 'panda-academy') {
			include ("./panda-academy.php");
		}else if ($page_to_serve == 'contacto') {
			include ("./contacto.php");
		}else if ($page_to_serve == 'crear-cuenta') {
			include ("./crear-cuenta.php");
		}else if ($page_to_serve == 'login') {
			include ("./login.php");
		}
		else {
			// Normal index page
			include ("./elements/homepage.php");
			//include ("./elements/panda_school.php");
		}
	?>
		<script src="js/vendor/popper.min.js"></script>
		<script src="js/vendor/bootstrap.bundle.min.js"></script>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="js/vendor/ie10-viewport-bug-workaround.js"></script>
		<script src="js/vendor/webfontloader.min.js"></script>
		

		


		<!-- REVOLUTION SLIDER -->
		<script type="text/javascript" src="js/revolutionslider/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="js/revolutionslider/jquery.themepunch.tools.min.js"></script>
		<script type='text/javascript' src='js/revolutionslider/revolution-addons/particles/js/revolution.addon.particles.min.js?ver=1.0.3'></script>
		
		
		<!-- PAGE OPTIONS - You can find special scripts for this version -->
		<!--script type="text/javascript" src="content/rise-01/js/plugins.js?v=2.1"></script-->
		<!-- MAIN SCRIPTS - Classic scripts for all theme -->
		<script type="text/javascript" src="js/scripts.js?v=2.2"></script>


		<script src="js/frontend.js"></script>
		<!-- END JS FILES -->
    </body>
</html>

