<?php
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    header("Location: index.php");
}

echo Account::CreateUser($_GET['username'], $_GET['password'], $_GET['cpassword'], $_GET['email']);
?>