<?php

header('Content-Type: application/json');

include('../class/include.php');

if (!Account::isAuthentified() || !CSRF::isAjaxRequest())

{

	http_response_code(403);

    die("Bad request");

}

if(!Account::IsAdmin()) {
	die("Bad request");
}

$id = $_POST['id'];

if(empty($id))
{
	http_response_code(403);
    die("Bad request");
} 
else {
	Account::Validate($id);
}



?>