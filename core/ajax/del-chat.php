<?php
include('../class/include.php');
if (!Account::isAuthentified() && !CSRF::isAjaxRequest())
{
	http_response_code(403);
    die("Bad request");
}
if(!Account::IsAdmin())
{
	http_response_code(403);
	die("Bad request");
}

$pseudo = Account::GetUsername();

Chat::DelChat();
Logs::AddLogs("<p class='text-danger'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-close'></i>&nbsp;L'utilisateur ".$pseudo." à clear le chat</p>");
?>