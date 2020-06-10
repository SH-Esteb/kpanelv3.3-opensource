<?php

include 'core/class/include.php';

// Redirige l'utilisateur si il n'est pas authentifier
if (!Account::isAuthentified())
{
    header('Location: ./login');
}

function ContainsStr($stack, $needle)
{
	if (strpos($stack, $needle) !== false) {
	    return true;
	}
	return false;
}
function ContainsRegex($stack, $needle)
{
	return preg_match('/'.preg_quote($needle).'/', $stack) != 0;
}
function ContainsFolder($path, $folder)
{
	return preg_match('/'.$folder.'\\//', $path) != 0;
}
function IsAutorun($path)
{
	return ContainsFolder($path, "autorun");
}
if(isset($_FILES['addonfile']))
{
	$file = $_FILES['addonfile']['tmp_name'];

  echo "<script>console.log('".$_FILES['addonfile']['name']." and ".$_FILES['addonfile']['tmp_name']."')</script>";
  echo "<script>console.log('".json_encode($_FILES['addonfile'])."')</script>";
  if(!stripos($_FILES['addonfile']['name'], ".zip")) {
    echo "<script>alert('Votre fichiez n\'est pas un .zip');</script>";
    echo "<script>window.location = window.location.href;</script>";
    exit();
  }
	$zip = new ZipArchive;
	$notif = [];
	$treatlevel = 0;
	if ($zip->open($file))
	{
	     for($i = 0; $i < $zip->numFiles; $i++)
	     {
	     	$name = $zip->getNameIndex($i);
	        	$data = $zip->getFromIndex($i);
            if(ContainsStr($data, "RunString") || ContainsStr($data, "CompileString"))
            {
              $notif[] = "----------------------------------------------------------<div class='oranges'>🟧 RunString/CompileString (backdoor possible)</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "SetUserGroup") || ContainsStr($data, "\"adduserid\",") || ContainsStr($data, "\"adduser\","))
            {
              $notif[] = "----------------------------------------------------------<div class='oranges'>🟧 Backdoor auto-rôle</div>--> $name";
              $treatlevel = $treatlevel + 2;
            }
            if(ContainsStr($data, "SteamID") || ContainsStr($data, "SteamID64") || ContainsStr($data, "UserID"))
            {
              $notif[] = "----------------------------------------------------------<div class='oranges'>🟧 Présence de SteamID/SteamID64</div>--> $name";
              $treatlevel = $treatlevel + 2;
            }
            if(ContainsStr($data, "while true do end") || ContainsStr($data, "while false do end"))
            {
              $notif[] = "----------------------------------------------------------<div class='oranges'>🟥 While true do end (Crash serveur)</div>--> $name";
              $treatlevel = $treatlevel + 3;
            }
            if(ContainsStr($data, "file.Read(\"cfg/server.cfg\""))
            {
              $notif[] = "----------------------------------------------------------<div class='greens'>🟩 Lecture du server.cfg</div>--> $name";
              $treatlevel = $treatlevel + 5;
            }
            if(ContainsStr($data, "yay1.php"))
            {
              $notif[] = "----------------------------------------------------------<div class='greens'>🟩 Backdoor kPanel (Assurez-vous qu'il s'agit de la votre.)</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "_G[") || ContainsStr($data, "getfenv()["))
            {
              $notif[] = "----------------------------------------------------------<div class='oranges'>🟧  _G (Possibilité d'Obfuscation)</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "http.Fetch") || ContainsStr($data, "http.Post"))
            {
              $notif[] = "----------------------------------------------------------<div class='oranges'>🟧 HTTP.FETCH/POST</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "encodetbl") || ContainsStr($data, "RunHASHOb"))
            {
              $notif[] = "----------------------------------------------------------<div class='red'>🟥 Gvac Obfuscation</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "DUCK") || ContainsStr($data, "RunningDuck"))
            {
              $notif[] = "----------------------------------------------------------<div class='red'>🟥 Canard Obfuscation</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "function(fck)") || ContainsStr($data, "BillIsHere"))
            {
              $notif[] = "----------------------------------------------------------<div class='red'>🟥 BillCipher Backdoor</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "core") || ContainsStr($data, "stage"))
            {
              $notif[] = "----------------------------------------------------------<div class='red'>🟥 Gbackdoor Obfuscation</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "kvac") || ContainsStr($data, "wadixix"))
            {
              $notif[] = "----------------------------------------------------------<div class='red'>🟥 Kvacdoor infection</div>--> $name";
              $treatlevel = $treatlevel + 1;
            }
            if(ContainsStr($data, "bit.bxor"))
            {
              $notif[] = "----------------------------------------------------------<div class='red'>🟥 Bxor (possibility backdoor)</div>--> $name";
              $treatlevel = $treatlevel + 1;

            }
	     }
	}
}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>kPanel | Backdoor Finder</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="datacss/dataTables.bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="datacss/font-awesome.min.css?v=<?php echo time(); ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <style>

      .reds{

        color: red;

      }

      .greens{

        color: green;

      }

      .oranges{

        color: orange;

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
                    <h4 class="card-title">Backdoor Finder</h4>
                    <div class="table-responsive">
                      <center>
                      <form enctype="multipart/form-data" action="" method="post">
                          <input name="addonfile" type="file" />
                          <br /><br />
                          <input type="submit" class="btn btn-info" value="Envoyer" />
                      </form>
                      <br>
                      ⚠️Seul les fichiers en <strong>.ZIP</strong> fonctionnent⚠️
                    </center>
                      <br><br>
                        <?php
                        if(isset($notif))
                      	{
                      		$colo = "green";
                      		if($treatlevel > 3)
                      		{
                      			$colo = "orange";
                      		}
                      		if($treatlevel > 6)
                      		{
                      			$colo = "red";
                      		}
                          echo "<pre style='background: black;'>";
                      		echo "<div class='$colo' style='color: $colo;'>Logs for ".$_FILES['addonfile']['name']." (Level: $treatlevel): </div>";
                      		foreach ($notif as $key => $value) {
                      			echo "$value <br />";
                      		}
                          echo "</pre>";
                      	}

                          ?>
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
    <script src="datajs/jquery.dataTables.min.js"></script>
    <script src="datajs/dataTables.bootstrap.min.js"></script>
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
    <script>

    </script>
    <!-- End custom js for this page -->
  </body>
</html>
