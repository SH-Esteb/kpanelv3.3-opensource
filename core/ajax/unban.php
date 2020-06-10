<?php

include('../class/include.php');

if (!Account::isAuthentified() || !CSRF::isAjaxRequest())

{
	http_response_code(403);
    die("Bad request");

}

if(!Account::IsAdmin())
{
	http_response_code(403);
	die("Bad request");
}

$varuser = $_GET['id'];

Account::UnBan($varuser);


?>
