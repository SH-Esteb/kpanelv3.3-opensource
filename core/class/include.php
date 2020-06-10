<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('Europe/Paris');
include 'Config.php';
include 'Database.php';
include 'CSRF.php';
include 'Account.php';
include 'Server.php';
include 'Payload.php';
include 'Logs.php';
include 'Params.php';
include 'Chat.php';

$GLOBALS['DB'] = new Database($GLOBALS['mysql_host'], $GLOBALS['mysql_database'], $GLOBALS['mysql_username'], $GLOBALS['mysql_password']);

if (Account::IsBanned()) { die('
<html><head>
    <title>You Are Banned</title>
    <link rel="stylesheet" type="text/css" href="https://kpanel.cz/assets/css/error.css">
  <meta id="Reverso_extension___elForCheckedInstallExtension" name="Reverso extension" content="2.2.194"></head>
  <body>
    <div id="notfound">
      <div class="notfound">
        <div class="notfound-404">
          <h1>BANNED</h1>
          <h2>Banned From kPanel</h2>
        </div>
        <a href="https://discord.gg/rQGmWpr" target="_blank">DISCORD</a>
      </div>
    </div>

</body></html>
'); } ?>
