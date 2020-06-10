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
    <title>kPanel | Dashboard</title>
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
    <style>
    .faq-question-q-box {
        height: 30px;
        width: 30px;
        color: #6658dd;
        text-align: center;
        border-radius: 50%;
        float: left;
        font-weight: 700;
        line-height: 30px;
        background-color: rgba(102,88,221,.15);
    }
    .faq-question {
        margin-top: 0;
        margin-left: 50px;
        font-weight: 400;
        font-size: 16px;
    }
    .faq-answer {
        margin-left: 50px;
        color: #98a6ad;
    }
    .offset-lg-1 {
        margin-left: 2.33333%;
    }
    .mb-3, .my-3 {
        margin-bottom: 0.5rem!important;
    }
    .pt-5, .py-5 {
        padding-top: 4.5rem!important;
    }
    </style>
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
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="text-center">
                    <i class="mdi mdi-clipboard-text mdi-4x thisone" aria-hidden="true" style="font-size: 2rem;"></i>
                    <h3 class="mb-3">Règlement</h3>
                    <p class="text-muted">Tout non respect du règlement ce résulterat d'un bannisement permanent.</p>
                    </div>
                    <div class="row pt-5">
                    <div class="col-lg-5 offset-lg-1">
                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question" data-wow-delay=".1s">Est-ce que je peux donner, vendre ou prêter mon compte kPanel ?</h4>
                    <p class="faq-answer mb-4">Non le partage, la vente ou le prêt de son compte kPanel est strictement interdit sauf sous autorisation.</p>
                    </div>
                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question">Mauvaise utilisation de kPanel</h4>
                    <p class="faq-answer mb-4">Toute utilisation du panel ayant pour but d'affecter le site, les machines du panel, le panel, les admins du panel ou les clients du panel kPanel et/ou la Kalysia, les membres de la Kalysia ou les clients de leurs produits de façon négative est interdite et se résultera par un bannissement.</p>
                    </div>
                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question">Est-ce que j'ai le droit de me servir de kPanel pour me faire de l'argent ?</h4>
                    <p class="faq-answer mb-4">La vente de service liée à kPanel est autorisée sous certaines conditions.</p>
                    </div>
                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question" data-wow-delay=".1s">Est-ce que j'ai le droit de me servir de kPanel ou autre chose liée à kPanel pour me faire de l'argent ?</h4>
                    <p class="faq-answer mb-4">Oui, recevoir de l'argent grâce à kPanel ou vendre un service, objet, logiciel, contenu vidéo etc lié à kPanel et ses membres et/ou à Kalysia et ses membres est autorisé sous certaines conditions (exemple: Retirer une backdoor d'un serveur, vendre un dll, vendre des payload/visuels, vendre des menus, scam une personne, vendre des info sur un serveur etc)</p>
                    </div>
                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question" data-wow-delay=".1s">L'utilisation de doubles comptes ?</h4>
                    <p class="faq-answer mb-4">Il est interdit d'utiliser des doubles comptes.</p>
                    </div>


                    </div>
                    <div class="col-lg-5 offset-lg-1">
                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question">kPanel propose-t-il un programme de <a href="https://fr.wikipedia.org/wiki/Bug_bounty" target="_newblank">Bug bounty</a> ?</h4>
                    <p class="faq-answer mb-4">Toute personne rapportant des bugs/exploits sur kPanel sera récompensée en fonction de la gravité du bug/exploit s'il ne détruit pas kPanel avec. (Il est possible que le bug soit tout petit et qu'il n'y ait aucune récompense, car pas assez important).</p>
                    </div>
                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question">Règlement Social</h4>
                    <p class="faq-answer mb-4">Toute alliance avec une équipe, une écurie, une armée, un arsenal, une bande, une brigade, un camp, un collectif, un escadron, une escouade, une formation, un laboratoire, un peloton, un régiment, une team, une troupe et/ou une union de personnes hostiles à kPanel et/ou le site, les machines du panel, le panel, les admins du panel ou les acheteurs du panel kPanel et/ou à Kalysia, les membres de la Kalysia ou les acheteurs de leurs produits se résultera par un bannissement.</p>
                    </div>

                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question" data-wow-delay=".1s">Règlement du Workshop Steam</h4>
                    <p class="faq-answer mb-4">Il est interdit de poster des backdoors sur le workshop steam quel que soit l'addon ou les serveurs qui l'ont dans leurs collections.
                    </p>
                    </div>
                    <div>
                    <div class="faq-question-q-box">Q.</div>
                    <h4 class="faq-question" data-wow-delay=".1s">J'ai le droit de récupérer les html de kPanel ?</h4>
                    <p class="faq-answer mb-4">Non il vous est totalement interdit de récupérer les html du panel kPanel sauf sous certaines conditions.</p>
                    </div>
                    </div>
                    </div>
                </div>
              </div>
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
