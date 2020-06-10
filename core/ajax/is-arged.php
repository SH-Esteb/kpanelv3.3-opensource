<?php

include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad request");
}

function contains($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

$payload_id = $_GET['id'];

$payload = html_entity_decode(Payload::GetPayload($payload_id)['payload_content']);

if(stripos($payload, "{ARG}") == true) {
  echo "true";
} else {
  echo "false";
}

?>
