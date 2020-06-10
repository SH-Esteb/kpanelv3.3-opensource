<?php
header('Content-Type: application/json');
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad request");
}

if(!Account::IsAdmin())
{
	http_response_code(403);
	die("Bad request");
}

Account::DeleteUser($_GET['id']);
?>
