<?php
include("../core/class/include.php");


if(isset($_GET['discord'])) {
  if($_GET['discord'] == "not_in") {
    $notin = true;
    session_unset();
    session_destroy();
  } else {
    $notin = false;
    session_unset();
    session_destroy();
    $disname = $_GET['discord'];
  }
} else {
  header("Location: /index.php");
}

?>



<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="https://kpanel.cz/home/assets/img/logo/kpanel.png">
    <link rel="icon" type="image/png" href="https://kpanel.cz/home/assets/img/logo/kpanel.png">
	<title>kPanel | Erreur</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:600|Source+Sans+Pro:600,700" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/applify.min.css"/>
</head>
<body class="ui-transparent-nav" data-fade_in="on-load">

	<!-- Navbar Fixed + Default -->
    <nav class="navbar navbar-fixed-top transparent navbar-dark bg-dark-gray">
		<div class="container">

			<!-- Navbar Logo -->
			<a class="ui-variable-logo navbar-brand" href="#" title="kPanel">
				<!-- Default Logo -->
				<img class="logo-default" src="assets/img/logo/kPanel-v3.png" alt="kPanel" data-uhd>
				<!-- Transparent Logo -->
				<img class="logo-transparent" src="assets/img/logo/kPanel-v3.png" alt="kPanel" data-uhd>
			</a><!-- .navbar-brand -->

			<!-- Navbar Navigation -->
			<div class="ui-navigation navbar-center">
				<ul class="nav navbar-nav">
                    <!-- Nav Item -->
					<li>
						<a href="./">Acceuil</a>
					</li>
				</ul><!--.navbar-nav -->
			</div><!--.ui-navigation -->

			<!-- Navbar Button -->
      <?php if (!Account::isAuthentified()) { ?>
			<a href="../login" class="btn btn-sm ui-gradient-peach pull-right">LOGIN</a>

      <a href="../login" class="btn btn-sm ui-gradient-peach pull-right">S'ENREGISTRER</a>
      <?php } else { ?>
      <a href="../dashboard" class="btn btn-sm ui-gradient-peach pull-right">RETOUR AU PANEL</a>
      <?php } ?>
			<!-- Navbar Toggle -->
			<a href="#" class="ui-mobile-nav-toggle pull-right"></a>

		</div><!-- .container -->
	</nav> <!-- nav -->

	<!-- Main Wrapper -->
    <div class="main" role="main">

    	<!-- Hero -->
		<div class="ui-hero hero-lg hero-center hero-bg ui-curve hero-svg-layer-4 bg-dark-gray" >
			<div class="container">
				<div class="row pt-2 pb-6">
					<div class="col-sm-12" data-vertical_center="true" data-vertical_offset="16">
            <?php if($notin == false) {?>
						<h1 class="heading animate" data-show="fade-in-up-big" data-delay="100">
							Vous êtes sur un <span class="text-red">serveur blacklist</span>, Merci de bien vouloir quitter le serveur:<br> <span class="text-red"><?php echo $disname; ?></span>
						</h1>
          <?php } else {?>
              <h1 class="heading animate" data-show="fade-in-up-big" data-delay="100">
              Vous n'êtes pas sur le <span class="text-red">discord kPanel</span>, Merci de bien vouloir rejoindre le serveur.<br><br>
              <a href="https://discord.gg/Q6mJwR2" class="btn btn-sm ui-gradient-peach pull-right">REJOINDRE</a>
              </h1>
          <?php } ?>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .ui-hero -->



    </div><!-- .main -->

    <!-- Scripts -->
	<script type="text/javascript" src="assets/js/libs/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="assets/js/libs/slider-pro/jquery.sliderPro.min.js"></script>
	<script type="text/javascript" src="assets/js/libs/owl.carousel/owl.carousel.min.js"></script>
  <script data-ad-client="ca-pub-7575386948532413" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!--
    # Google Maps
    # Add Your Google Maps API Key Below !!
    -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5B2iXEELo6aIReGYLJdVKBlzHnrM0YLU"></script>
	<script type="text/javascript" src="assets/js/applify/ui-map.js"></script>
	<script type="text/javascript" src="assets/js/libs/form-validator/form-validator.min.js"></script>
	<script type="text/javascript" src="assets/js/libs/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/applify/build/applify.js"></script>
</body>

</html>
