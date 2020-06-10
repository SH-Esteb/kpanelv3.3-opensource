<?php
include("../core/class/include.php");

function apiRequestBotDiscord($url, $post = false, $headers = array())
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($ch);
        $headers[] = 'Authorization: Bot NzE2NjM1Nzg1ODUxNDM3MTM3.XtPA0A.aSEc61vWGYeDmqpOezA7BhZDhPg';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return json_decode($response);
    }

$access = 1;

if ($access == 0) {
  header("Location: ../index.php");
}

?>

<html lang="fr">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="https://kpanel.cz/home/assets/img/logo/kpanel.png">
    <link rel="icon" type="image/png" href="https://kpanel.cz/home/assets/img/logo/kpanel.png">
	<title>kPanel | Accueil</title>
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
						<a href="#" data-scrollto="features">Caractéristiques</a>
					</li>
					<!-- Nav Item -->
					<li>
						<a href="https://discord.gg/rQGmWpr">Discord</a>
					</li>
					<!-- Nav Item -->
					<li>
						<a href="#" data-scrollto="pricing">Prix</a>
					</li>
					<li>
						<a href="#" data-scrollto="testimonial">Avis</a>
					</li>
          <li>
            <a href="https://api.kpan.ml/">API</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="tools" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Outils</a>

          <div class="dropdown-menu" aria-labelledby="tools">
          <a class="dropdown-item" href="https://kpanel.cz/tools/ipinfo.php" style="color: black;">Ip-Info</a>
        </div>
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
						<h1 class="heading animate" data-show="fade-in-up-big" data-delay="100">
							Panel d'administration <span class="text-red">facile d'utilisation</span> &amp; <span class="text-red">gratuit</span> pour Garry's Mod
						</h1>

                        <!-- * Replace data-video with your youtube video id -->
                        <a href="#" class="ui-video-toggle mt-4" data-video="XXXXXXXXXXX">
                            <span class="icon fa fa-play bg-red"></span> <span>Présentation du panel</span>
                        </a>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .ui-hero -->

        <!-- Intro Image -->
        <div class="section intro-image pt-0">
            <img src="assets/demo/img/mockups/kpan.png?v=3.2" data-uhd data-max_width="1000" class="shadow-xxl responsive-on-lg" alt="kPanel" />
        </div><!-- .intro-image -->

        <!-- App Features Section -->
		<div id="features" class="section pt-0">
   			<div class="container ui-icon-blocks ui-blocks-h icons-lg">
   				<div class="section-heading cente">
   					<h2 class="heading text-dark-gray">
   						Fonctionnalités
   					</h2>
   					<p class="paragraph">
   						Ce que vous propose le panel.
   					</p>
   				</div><!-- .section-heading -->
   				<div class="row">
   					<div class="col-sm-4 ui-icon-block">
   						<div class="icon icon-lg icon-circle icon-layers text-red"></div>
   						<h4 class="text-dark-gray">Administration</h4>
						<p>
							Pour commencer à administrer un serveur, glissez le code lua fourni avec votre compte kPanel dans votre serveur garry's mod
						</p>
   					</div>
   					<div class="col-sm-4 ui-icon-block">
   						<div class="icon icon-lg icon-circle icon-rocket text-red"></div>
   						<h4 class="text-dark-gray">Payloads</h4>
   						<p>
							Le système de payload vous permet de lancer des codes lua rapidement par vous ou par le staff de kPanel sur vos serveurs.
						</p>
   					</div>
   					<div class="col-sm-4 ui-icon-block">
   						<div class="icon icon-lg icon-circle icon-ban text-red"></div>
   						<h4 class="text-dark-gray">Obfuscateur</h4>
						<p>
							Grace à l'obfuscateur rendez n'importe quelle code lua totalement illisible
						</p>
   					</div>
   				</div><!-- .row -->
   			</div><!-- .container -->
   		</div><!-- .section -->


  		<!-- Showcase Section -->
   		<div class="section laptop-showcase">
   			<div class="container">
   				<div class="row">
                    <div class="col-md-5 col-lg-4" data-vertical_center="true">
	                    <div>
	                        <h2 class="heading text-dark-gray">
	                            Conçu pour tous
	                        </h2>
	                        <p>
	                            Le panel a été fait pour tout le monde, aussi simple que possible afin que même les plus jeunes puissent le comprendre et l'utiliser.
	                        </p>
	                        <a href="../register.php" class="btn ui-gradient-peach">COMMENCER</a>
	                    </div>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <img class="responsive-on-sm laptop" src="assets/demo/img/mockups/kpan.png?v=3.2" data-uhd alt="kPanel-Look" data-max_width="1000" />
                    </div>
                </div>

   			</div><!-- .container -->
   		</div><!-- .section -->


	    <!-- Stats Section -->
	    <div id="support" class="section bg-dark-gray">
		    <div class="container">
			    <div class="row">
				    <!-- Text Column -->
				    <div class="col-lg-6 col-md-5" data-vertical_center="true">
					    <!-- Section Heading -->
					    <div class="section-heading mb-0 center-on-md">
						    <h2 class="heading">
							    Statistiques
						    </h2>
						    <p class="paragraph">
							    Voici comment se porte le panel.
						    </p>
						    <div class="row ui-icon-blocks ui-blocks-h icons-md mt-2">
							    <div class="col-4 ui-icon-block animate text-left mb-0 center-on-md" data-show="fade-in-up">
								    <div class="icon icon-user"></div>
								    <h4 class="heading mb-1"><?php echo $GLOBALS['DB']->Count('users');?></h4>
								    <p>
									    Utilisateurs
								    </p>
							    </div>
							    <div class="col-4 ui-icon-block animate text-left mb-0 center-on-md" data-show="fade-in-up">
								    <div class="icon icon-layers"></div>
								    <h4 class="heading mb-1"><?php echo $GLOBALS['DB']->Count('server_list');?></h4>
								    <p>
									    Serveurs
								    </p>
							    </div>
							    <div class="col-4 ui-icon-block animate text-left mb-0 center-on-md" data-show="fade-in-up">
								    <div class="icon icon-list"></div>
								    <h4 class="heading mb-1"><?php echo $GLOBALS['DB']->Count('payload');?></h4>
								    <p>
									    Payloads Créer
								    </p>
							    </div>
                  <div class="col-4 ui-icon-block animate text-left mb-0 center-on-md" data-show="fade-in-up">
                    <div class="icon icon-feed"></div>
                    <h4 class="heading mb-1"><?php echo $GLOBALS['DB']->Count('logs');?></h4>
                    <p>
                      Requetes
                    </p>
                  </div>
						    </div><!-- .row -->
					    </div><!-- .section-heading -->
				    </div>
				    <!-- Image Column -->
				    <div class="col-lg-6 col-md-7 img-block animate" data-show="fade-in-left"  data-vertical_center="true">
					    <img src="assets/img/support/applify-support.png" alt="Stats" data-uhd class="img-fluid" data-max_width="460" />
				    </div>
			    </div><!-- .row -->
		    </div><!-- .container -->
	    </div><!-- .section -->

   		<!-- Pricing Cards Section -->
   		<div id="pricing" class="section bg-light">
   			<div class="container">
   				<!-- Section Heading -->
   				<div class="section-heading center">
   					<h2 class="heading text-dark-gray">
   						Prix
   					</h2>
   					<p class="paragraph">
   						Le prix de ce panel indépendant.
   					</p>
   				</div><!-- .section-heading -->

   				<!-- UI Pricing Cards / Owl Carousel On Mobile -->
   				<div class="ui-pricing-cards owl-carousel owl-theme">
   					<!-- Card 1 -->
            <div class="ui-card ui-curve color-card shadow-xl">
            </div>
   					<!-- Card 2 -->
   					<div class="ui-pricing-card active animate" data-show="fade-in">
						<div class="ui-card ui-curve color-card shadow-xl">
							<div class="card-header ui-gradient-peach">
								<!-- Heading -->
								<h4 class="heading">Gratuit</h4>
								<!-- Price -->
								<div class="price">
									<span class="price">0</span>
                  <span class="curency">&euro;</span>
									<span class="period">/lifetime</span>
								</div>
								<h6 class="sub-heading">24/7 Support</h6>
							</div>
							<!-- Features -->
							<div class="card-body">
								<ul>
									<li>
										Payloads illimités,
									</li>
									<li>
										Encodeur / Décodeur,
									</li>
									<li>
										Tutoriels,
									</li>
									<li>
										Et bien plus encore !
									</li>
								</ul>
								<a href="../login.php" class="btn bg-dark-gray shadow-md">C'est parti !</a>
							</div>
						</div>
  					</div>
  					<!-- Card 3 -->

   				</div><!-- .ui-pricing-cards -->

   				<!-- Pricing Footer -->
   				<div class="ui-pricing-footer">
   					<p class="paragraph">
   						Le panel est gratuit, et ça le restera.
   					</p>
   				</div><!-- .ui-pricing-footer -->

   			</div><!-- .container -->
   		</div><!-- .section -->

        <!--  Testimonial Section -->
   		<div class="section" id="testimonial">
   			<div class="container">
   				<!-- Card Heading -->
   				<div class="section-heading center">
   					<h2 class="heading text-dark-gray">
   						Ce que les gens disent
   					</h2>
   					<p class="paragraph">
   						Les avis de nos utilisateurs.
   					</p>
   				</div><!-- .section-heading -->

   				<!-- Slider  -->
				<div class="ui-testimonials slider owl-carousel owl-theme">
					<!-- Testimonials Item 1 -->
					<div class="item">
						<?php $user = apiRequestBotDiscord("https://discord.com/api/users/385437763769466880") ?>

						<!-- Card -->
						<div class="ui-card shadow-md">
							<p>Je pense que kPanel est un très bon panel qui panelle.</p>
						</div>
						<!-- User -->
						<div class="user">
							<div class="avatar"><img alt="<?php echo $user->username;?>" src="<?php echo "https://cdn.discord.com/avatars/{$user->id}/{$user->avatar}" ?>"></div>
							<div class="info">
								<h6 class="heading text-dark-gray"><?php echo $user->username;?></h6>
								<p class="sub-heading">NKVD - kPanel</p>
							</div>
						</div>
					</div>
          <div class="item">
						<?php $user = apiRequestBotDiscord("https://discord.com/api/users/713048773194154026") ?>
            <!-- Card -->
            <div class="ui-card shadow-md">
              <p>Un panel simple, rapide, efficace et gratuit.</p>
            </div>
            <!-- User -->
            <div class="user">
              <div class="avatar"><img alt="<?php echo htmlentities($user->username);?>" src="<?php echo "https://cdn.discordapp.com/avatars/{$user->id}/{$user->avatar}" ?>"></div>
              <div class="info">
                <h6 class="heading text-dark-gray"><?php echo $user->username;?></h6>
                <p class="sub-heading">Admin - Omega Project</p>
              </div>
            </div>
          </div>
          <div class="item">
						<?php $user = apiRequestBotDiscord("https://discord.com/api/users/444505215673303061") ?>
            <!-- Card -->
            <div class="ui-card shadow-md">
              <p>Panel beau esthétiquement, Fluide Aucun bug tous ce qu'il faut pour punir les serveurs qui leaks !</p>
            </div>
            <!-- User -->
            <div class="user">
              <div class="avatar"><img alt="<?php echo htmlentities($user->username);?>" src="<?php echo "https://cdn.discordapp.com/avatars/{$user->id}/{$user->avatar}" ?>"></div>
              <div class="info">
                <h6 class="heading text-dark-gray"><?php echo htmlentities($user->username);?></h6>
                <p class="sub-heading">Membre</p>
              </div>
            </div>
          </div>
					<div class="item">
						<?php $user = apiRequestBotDiscord("https://discord.com/api/users/568003681060913153") ?>
            <!-- Card -->
            <div class="ui-card shadow-md">
              <p>Panel Super,Efficace,Simple 100% Gratuit !</p>
            </div>
            <!-- User -->
            <div class="user">
              <div class="avatar"><img alt="<?php echo htmlentities($user->username);?>" src="<?php echo "https://cdn.discordapp.com/avatars/{$user->id}/{$user->avatar}" ?>"></div>
              <div class="info">
                <h6 class="heading text-dark-gray"><?php echo htmlentities($user->username);?></h6>
                <p class="sub-heading">Membre</p>
              </div>
            </div>
          </div>
          <div class="item">
						<?php $user = apiRequestBotDiscord("https://discord.com/api/users/389000921180405760") ?>
            <!-- Card -->
            <div class="ui-card shadow-md">
              <p>J'adore le nouveau design il est super cool et ergonomique en plus le site n'a pas de latence 5/5</p>
            </div>
            <!-- User -->
            <div class="user">
              <div class="avatar"><img alt="<?php echo htmlentities($user->username);?>" src="<?php echo "https://cdn.discordapp.com/avatars/{$user->id}/{$user->avatar}" ?>"></div>
              <div class="info">
                <h6 class="heading text-dark-gray"><?php echo htmlentities($user->username);?></h6>
                <p class="sub-heading">Membre</p>
              </div>
            </div>
          </div>
				</div><!-- .ui-testimonials  -->
   			</div><!-- .container -->
   		</div><!-- .section -->

   		<!-- Footer -->
   		<footer class="ui-footer bg-gray">
   			<div class="footer-copyright bg-dark-gray">
   				<div class="container">
					<div class="row">
						<!-- Copyright -->
						<div class="col-sm-6 center-on-sm">
							<p>
								&copy; <?php echo date("Y"); ?> <a href="#" target="_blank" title="kPanel">kPanel</a>
							</p>
						</div>
					</div>
   				</div><!-- .container -->
   			</div><!-- .footer-copyright -->

   		</footer><!-- .ui-footer -->

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
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5dcc15ed43be710e1d1d1da5/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>

</html>
