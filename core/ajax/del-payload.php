<?php
header('Content-Type: application/json');
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad request");
}

if (!Payload::IsOwner($_SESSION['id'],$_GET['id'])) {
    die("Bad request");
}

Payload::DeletePayload($_GET['id']);
?>
