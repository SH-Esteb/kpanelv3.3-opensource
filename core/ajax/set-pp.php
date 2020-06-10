<?php
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad Request");
}

$pptoset = $_POST['pp'];

echo Account::setPP($pptoset);

?>