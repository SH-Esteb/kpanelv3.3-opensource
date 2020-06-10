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


$varusertoupg = $_GET['usertoupg'];
$varroletoset = $_GET['roletoset'];

Account::setRole($varusertoupg, $varroletoset);


?>