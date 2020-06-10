<?php

header('Content-Type: application/json');
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
	http_response_code(403);
    die("Bad request");
}
$owner = Account::GetUser($id)['fuckkey'];

$content = str_replace("<NEWLINE>", "\n", $_POST['content']);
Payload::CreatePayload(htmlspecialchars($_POST['name']), $content, $owner, $_POST['side']);
?>
