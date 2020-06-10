<?php
include('../class/include.php');
if (!Account::isAuthentified() && !CSRF::isAjaxRequest())
{
	http_response_code(403);
    die("Bad request");
}
$id = $_SESSION['id'];
$pseudo = utf8_encode(Account::GetUsername($id));
$message = htmlspecialchars($_POST['message']);
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

if(!empty($message)) {
	if(!trim($message) == "") {

		$message = preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', '<a id="violet" target="blank" href="\0">\0</a>', $message );

		echo Chat::AddMessage($pseudo, $message, " <i style=\"font-size: 9.5px!important;\">(".date('d/m/Y à H:i:s', time()).")</i>", $id);
		Logs::AddLogs("<p class='text-success'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-plus'></i>&nbsp;L'utilisateur ".$pseudo." a ajouté un message dans le chat</p>");
	}
}
?>
