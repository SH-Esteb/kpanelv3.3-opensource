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


$varusertochange = $_SESSION['id'];
$varcolortoset = $_GET['color'];

echo Account::SetRoleColor($varusertochange, $varcolortoset);


?>
