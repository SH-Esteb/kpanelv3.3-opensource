<?php

$access = 1;

if ($access == 0) { ?>
<style>

.glitch {
  color: white;
  font-size: 150px;
  position: relative;
  display: inline-block;
}
.glitch::before,
.glitch::after {
  content: attr(data-text);
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: transparent;
}
.glitch::before {
  left: 2px;
  text-shadow: -2px 0 #49FC00;
  clip: rect(24px, 550px, 90px, 0);
  animation: glitch-anim-2 3s infinite linear alternate-reverse;
}
.glitch::after {
  left: -2px;
  text-shadow: -2px 0 #b300fc;
  clip: rect(85px, 550px, 140px, 0);
  animation: glitch-anim 2.5s infinite linear alternate-reverse;
}
@-webkit-keyframes glitch-anim {
  0% {
    clip: rect(67px, 9999px, 145px, 0);
  }
  4.166666666666666% {
    clip: rect(150px, 9999px, 42px, 0);
  }
  8.333333333333332% {
    clip: rect(148px, 9999px, 132px, 0);
  }
  12.5% {
    clip: rect(129px, 9999px, 84px, 0);
  }
  16.666666666666664% {
    clip: rect(14px, 9999px, 133px, 0);
  }
  20.833333333333336% {
    clip: rect(38px, 9999px, 48px, 0);
  }
  25% {
    clip: rect(13px, 9999px, 148px, 0);
  }
  29.166666666666668% {
    clip: rect(51px, 9999px, 90px, 0);
  }
  33.33333333333333% {
    clip: rect(35px, 9999px, 84px, 0);
  }
  37.5% {
    clip: rect(115px, 9999px, 81px, 0);
  }
  41.66666666666667% {
    clip: rect(1px, 9999px, 67px, 0);
  }
  45.83333333333333% {
    clip: rect(121px, 9999px, 61px, 0);
  }
  50% {
    clip: rect(40px, 9999px, 46px, 0);
  }
  54.166666666666664% {
    clip: rect(70px, 9999px, 115px, 0);
  }
  58.333333333333336% {
    clip: rect(141px, 9999px, 78px, 0);
  }
  62.5% {
    clip: rect(42px, 9999px, 11px, 0);
  }
  66.66666666666666% {
    clip: rect(20px, 9999px, 74px, 0);
  }
  70.83333333333334% {
    clip: rect(36px, 9999px, 8px, 0);
  }
  75% {
    clip: rect(2px, 9999px, 22px, 0);
  }
  79.16666666666666% {
    clip: rect(59px, 9999px, 58px, 0);
  }
  83.33333333333334% {
    clip: rect(31px, 9999px, 79px, 0);
  }
  87.5% {
    clip: rect(94px, 9999px, 16px, 0);
  }
  91.66666666666666% {
    clip: rect(86px, 9999px, 111px, 0);
  }
  95.83333333333334% {
    clip: rect(97px, 9999px, 96px, 0);
  }
  100% {
    clip: rect(95px, 9999px, 49px, 0);
  }
}
@keyframes glitch-anim {
  0% {
    clip: rect(67px, 9999px, 145px, 0);
  }
  4.166666666666666% {
    clip: rect(150px, 9999px, 42px, 0);
  }
  8.333333333333332% {
    clip: rect(148px, 9999px, 132px, 0);
  }
  12.5% {
    clip: rect(129px, 9999px, 84px, 0);
  }
  16.666666666666664% {
    clip: rect(14px, 9999px, 133px, 0);
  }
  20.833333333333336% {
    clip: rect(38px, 9999px, 48px, 0);
  }
  25% {
    clip: rect(13px, 9999px, 148px, 0);
  }
  29.166666666666668% {
    clip: rect(51px, 9999px, 90px, 0);
  }
  33.33333333333333% {
    clip: rect(35px, 9999px, 84px, 0);
  }
  37.5% {
    clip: rect(115px, 9999px, 81px, 0);
  }
  41.66666666666667% {
    clip: rect(1px, 9999px, 67px, 0);
  }
  45.83333333333333% {
    clip: rect(121px, 9999px, 61px, 0);
  }
  50% {
    clip: rect(40px, 9999px, 46px, 0);
  }
  54.166666666666664% {
    clip: rect(70px, 9999px, 115px, 0);
  }
  58.333333333333336% {
    clip: rect(141px, 9999px, 78px, 0);
  }
  62.5% {
    clip: rect(42px, 9999px, 11px, 0);
  }
  66.66666666666666% {
    clip: rect(20px, 9999px, 74px, 0);
  }
  70.83333333333334% {
    clip: rect(36px, 9999px, 8px, 0);
  }
  75% {
    clip: rect(2px, 9999px, 22px, 0);
  }
  79.16666666666666% {
    clip: rect(59px, 9999px, 58px, 0);
  }
  83.33333333333334% {
    clip: rect(31px, 9999px, 79px, 0);
  }
  87.5% {
    clip: rect(94px, 9999px, 16px, 0);
  }
  91.66666666666666% {
    clip: rect(86px, 9999px, 111px, 0);
  }
  95.83333333333334% {
    clip: rect(97px, 9999px, 96px, 0);
  }
  100% {
    clip: rect(95px, 9999px, 49px, 0);
  }
}
@-webkit-keyframes glitch-anim-2 {
  6.666666666666667% {
    clip: rect(76px, 9999px, 119px, 0);
  }
  10% {
    clip: rect(49px, 9999px, 61px, 0);
  }
  13.333333333333334% {
    clip: rect(117px, 9999px, 107px, 0);
  }
  16.666666666666664% {
    clip: rect(16px, 9999px, 89px, 0);
  }
  20% {
    clip: rect(46px, 9999px, 5px, 0);
  }
  23.333333333333332% {
    clip: rect(94px, 9999px, 75px, 0);
  }
  26.666666666666668% {
    clip: rect(114px, 9999px, 58px, 0);
  }
  30% {
    clip: rect(79px, 9999px, 0px, 0);
  }
  33.33333333333333% {
    clip: rect(120px, 9999px, 45px, 0);
  }
  36.666666666666664% {
    clip: rect(66px, 9999px, 140px, 0);
  }
  40% {
    clip: rect(32px, 9999px, 54px, 0);
  }
  43.333333333333336% {
    clip: rect(13px, 9999px, 54px, 0);
  }
  46.666666666666664% {
    clip: rect(112px, 9999px, 103px, 0);
  }
  50% {
    clip: rect(58px, 9999px, 101px, 0);
  }
  53.333333333333336% {
    clip: rect(63px, 9999px, 37px, 0);
  }
  56.666666666666664% {
    clip: rect(97px, 9999px, 80px, 0);
  }
  60% {
    clip: rect(51px, 9999px, 124px, 0);
  }
  63.33333333333333% {
    clip: rect(70px, 9999px, 117px, 0);
  }
  66.66666666666666% {
    clip: rect(82px, 9999px, 62px, 0);
  }
  70% {
    clip: rect(3px, 9999px, 149px, 0);
  }
  73.33333333333333% {
    clip: rect(126px, 9999px, 96px, 0);
  }
  76.66666666666667% {
    clip: rect(134px, 9999px, 109px, 0);
  }
  80% {
    clip: rect(120px, 9999px, 42px, 0);
  }
  83.33333333333334% {
    clip: rect(9px, 9999px, 130px, 0);
  }
  86.66666666666667% {
    clip: rect(77px, 9999px, 46px, 0);
  }
  90% {
    clip: rect(144px, 9999px, 91px, 0);
  }
  93.33333333333333% {
    clip: rect(124px, 9999px, 115px, 0);
  }
  96.66666666666667% {
    clip: rect(85px, 9999px, 98px, 0);
  }
  100% {
    clip: rect(53px, 9999px, 12px, 0);
  }
}
@keyframes glitch-anim-2 {
  6.666666666666667% {
    clip: rect(76px, 9999px, 119px, 0);
  }
  10% {
    clip: rect(49px, 9999px, 61px, 0);
  }
  13.333333333333334% {
    clip: rect(117px, 9999px, 107px, 0);
  }
  16.666666666666664% {
    clip: rect(16px, 9999px, 89px, 0);
  }
  20% {
    clip: rect(46px, 9999px, 5px, 0);
  }
  23.333333333333332% {
    clip: rect(94px, 9999px, 75px, 0);
  }
  26.666666666666668% {
    clip: rect(114px, 9999px, 58px, 0);
  }
  30% {
    clip: rect(79px, 9999px, 0px, 0);
  }
  33.33333333333333% {
    clip: rect(120px, 9999px, 45px, 0);
  }
  36.666666666666664% {
    clip: rect(66px, 9999px, 140px, 0);
  }
  40% {
    clip: rect(32px, 9999px, 54px, 0);
  }
  43.333333333333336% {
    clip: rect(13px, 9999px, 54px, 0);
  }
  46.666666666666664% {
    clip: rect(112px, 9999px, 103px, 0);
  }
  50% {
    clip: rect(58px, 9999px, 101px, 0);
  }
  53.333333333333336% {
    clip: rect(63px, 9999px, 37px, 0);
  }
  56.666666666666664% {
    clip: rect(97px, 9999px, 80px, 0);
  }
  60% {
    clip: rect(51px, 9999px, 124px, 0);
  }
  63.33333333333333% {
    clip: rect(70px, 9999px, 117px, 0);
  }
  66.66666666666666% {
    clip: rect(82px, 9999px, 62px, 0);
  }
  70% {
    clip: rect(3px, 9999px, 149px, 0);
  }
  73.33333333333333% {
    clip: rect(126px, 9999px, 96px, 0);
  }
  76.66666666666667% {
    clip: rect(134px, 9999px, 109px, 0);
  }
  80% {
    clip: rect(120px, 9999px, 42px, 0);
  }
  83.33333333333334% {
    clip: rect(9px, 9999px, 130px, 0);
  }
  86.66666666666667% {
    clip: rect(77px, 9999px, 46px, 0);
  }
  90% {
    clip: rect(144px, 9999px, 91px, 0);
  }
  93.33333333333333% {
    clip: rect(124px, 9999px, 115px, 0);
  }
  96.66666666666667% {
    clip: rect(85px, 9999px, 98px, 0);
  }
  100% {
    clip: rect(53px, 9999px, 12px, 0);
  }
}

</style>
<?php
if (isset($_GET['id'])) {
  $musicid = $_GET['id'];
} else {
  $musicid = rand(1,13);
}
if ($musicid == 1) {
  $music = "https://kpan.ml/swing.mp3";
} else if ($musicid == 2) {
  $music = "https://kpan.ml/badapple.mp3";
} else if ($musicid == 3) {
  $music = "https://kpan.ml/env-firefrost.mp3";
} else if ($musicid == 4) {
  $music = "https://kpan.ml/env-paladin.mp3";
} else if ($musicid == 5) {
  $music = "https://kpan.ml/visupremez.mp3";
} else if ($musicid == 6) {
  $music = "https://kpan.ml/mega.mp3";
} else if ($musicid == 7) {
  $music = "https://kpan.ml/overdose.mp3";
} else if ($musicid == 8) {
  $music = "https://kpan.ml/ijfjFJlfnLJFfd.mp3";
} else if ($musicid == 9) {
  $music = "https://kpanel.cz/assets/thf.mp3";
} else if ($musicid == 10) {
  $music = "https://kpan.ml/vani.mp3";
} else if ($musicid == 11) {
  $music = "https://kpan.ml/yarba.mp3";
} else if ($musicid == 12) {
  $music = "https://kpan.ml/unowenwashere.mp3";
} else if ($musicid == 13) {
  $music = "https://kpan.ml/badapple2.mp3";
} else {
  $musicid = 1;
  $music = "https://kpan.ml/swing.mp3";
}
?>
<!DOCTYPE html>
<html class="no-js fixed" lang="en">

<!-- Mirrored from kpanel.cz/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Nov 2019 19:29:04 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">

<title><?php echo $_SERVER['HTTP_HOST']; ?> | Suspendu (<?php echo $musicid;?>)</title>
<link rel='stylesheet' href='assetsindex/css/bootstrap.min.css?v=<?php echo time();?>'>
<link rel='stylesheet' href='assetsindex/css/style.css?v=<?php echo time();?>'>
<link rel='stylesheet' href='assetsindex/css/color.css?v=<?php echo time();?>'>
<link rel='stylesheet' href='assetsindex/css/title-size.css?v=<?php echo time();?>'>
<link rel='stylesheet' href='assetsindex/css/custom.css?v=<?php echo time();?>'>
<link rel="apple-touch-icon" sizes="76x76" href="https://kpanel.cz/home/assets/img/logo/kpanel.png">
<link rel="icon" type="image/png" href="https://kpanel.cz/home/assets/img/logo/kpanel.png">
</head>
<body style="filter: invert(1);">

  <div id="site-loader">
    <div class="loader"></div>
  </div>
  <style>
  </style>
  <div id="site-wrap">
    <div id="bg">
      <div id="img"></div>
      <div id="video"></div>
      <div id="overlay"></div>
      <div id="effect">
        <img src="assetsindex/img/bg/cloud-01.png?v=<?php echo time();?>" alt="" id="cloud1">
        <img src="assetsindex/img/bg/cloud-02.png?v=<?php echo time();?>" alt="" id="cloud2">
        <img src="assetsindex/img/bg/cloud-03.png?v=<?php echo time();?>" alt="" id="cloud3">
        <img src="assetsindex/img/bg/cloud-04.png?v=<?php echo time();?>" alt="" id="cloud4">
      </div>
      <canvas id="js-canvas"></canvas>
    </div>
    <header id="site-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="header-brand">
            </div>
            <div class="header-toggle">
              <div id="menu-toggle" class="toggle">
                <i class="ion-information-circled"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div id="form">
      <div id="subscribe">
        <div class="tb-cell">
          <p class="animation section-subtitle">Que ce passe-t-il ?</p>
          <h2 class="section-title">Une mise à jour est en cour :3</h2>
        </div>
      </div>
    </div>
    <main id="site-main">
      <section id="home">
        <div class="section-wrap">
          <div class="section-cell">
            <div class="container">
              <div class="section-header row text-center">
                <div class="col-xs-12">
                  <p class="animation section-subtitle"><?php echo $_SERVER['HTTP_HOST']; ?> est fermé temporairement.</p>
                  <h1 class="section-title">
                    <span class="section-title-span glitch" data-text="kPan€l">kPanel</span>
                  </h1>
                  <div class="animation section-divider"></div>
                </div>
              </div>
              <div class="section-main row">
                <div class="col-xs-12">
                  <div id="countdown" class="animation-04">
				   <p class="animation section-subtitle">Fermé :</p>
                    <div class="row">
                      <div class="col-xs-3 col-countdown">

                        <div class="countdown-section">
                          <div class="countdown-amount days" id="d">0</div>
                          <div class="countdown-period days_ref" id="p1">JOURS</div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-countdown">
                        <div class="countdown-section">
                          <div class="countdown-amount hours" id="h">0</div>
                          <div class="countdown-period hours_ref" id="p2">HEURES</div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-countdown">
                        <div class="countdown-section">
                          <div class="countdown-amount minutes" id="m">0</div>
                          <div class="countdown-period minutes_ref" id="p3">MINUTES</div>
                        </div>
                      </div>
                      <div class="col-xs-3 col-countdown">
                        <div class="countdown-section">
                          <div class="countdown-amount seconds" id="s">0</div>
                          <div class="countdown-period seconds_ref" id="p4">SECONDS</div>
                        </div>
                      </div>
                    <?php if($musicid == 9) {?>
                    <br><br>
                    <p class="animation section-subtitle">Musique :</p>
                    <div class="col-countdown">
                        <div class="countdown-section">
                          Eternaltale OST - The Eternal Fight [Sans Battle Theme] | By Neonz Remix<br>
                          (EternalTale &copy; nico_s_Block)
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
    <footer id="site-footer">
      <a href="#" id="volume">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a>
    </footer>

    <audio  controls autoplay  id="audio-player" style="display:none">
      <source src="<?php echo $music; ?>" type="audio/mpeg">
    </audio>
  </div>
  <script src='assetsindex/js/vendor/jquery-2.1.4.min.js?v=<?php echo time();?>'></script>
  <script src='js/jquery.fadeaudio.js?v=<?php echo time();?>'></script>
  <script src='assetsindex/js/vendor/html5shiv.min.js?v=<?php echo time();?>'></script>
  <script src='assetsindex/js/vendor/bootstrap.min.js?v=<?php echo time();?>'></script>
  <script src='assetsindex/js/vendor/vendor.js?v=<?php echo time();?>'></script>
  <script src='assetsindex/js/variable.js?v=<?php echo time();?>'></script>
  <script src='assetsindex/js/main.js?v=<?php echo time();?>'></script>

</body>

<script>
// Set the date we're counting down to
var countDownDate = new Date("Jun 10, 2020 20:30:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
  document.getElementById("d").innerHTML = days;
  document.getElementById("h").innerHTML = hours;
  document.getElementById("m").innerHTML = minutes;
  document.getElementById("s").innerHTML = seconds;

  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("d").innerHTML = "0";
  	document.getElementById("h").innerHTML = "0";
  	document.getElementById("m").innerHTML = "0";
  	document.getElementById("s").innerHTML = "0";
    document.getElementById("p1").innerHTML = "PLEASE";
    document.getElementById("p2").innerHTML = "RELOAD";
    document.getElementById("p3").innerHTML = "THE";
    document.getElementById("p4").innerHTML = "PAGE";
    window.location.assign("https://kpanel.cz/home");
  }
}, 1000);
</script>


<!-- Mirrored from kpanel.cz/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Nov 2019 19:29:07 GMT -->
</html>
<?php } else {

  header('Location: https://kpanel.cz/home');

}
?>
