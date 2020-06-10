<?php
$browser = $_SERVER['HTTP_USER_AGENT'];
include('../class/include.php');



$server_ip = $_POST['i'];
$messages = $_POST['m'];

$server = Server::GetServerByIP($server_ip);
echo $server;
if($server == false)
{
	echo "no server";

}
$msgs = explode("\xFF", $messages);

foreach ($msgs as $msg) {
	$GLOBALS["DB"]->Insert("console", ["content" => $msg, "server_id" => $server]);
}

?>
