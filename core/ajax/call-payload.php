<?php
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad request");
}

if(empty($_GET['arg'])) {
  $arg = "-1";
} else {
  $arg = $_GET['arg'];
}

Server::CallPayload($_GET['server'], $_GET['payload'], $arg);
?>
