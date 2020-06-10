<?php
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad request");
}

if(empty($_GET['arg'])) {
  $arg = "-1";
} else {
  $arr =  explode(" ", $_GET['arg']);
  foreach($arr as $v){
      $final[] .= '"'.$v.'" ';
  }

  $rfinal = implode( ', ', $final );
  echo $rfinal;
}

Server::CallPayload($_GET['server'], "1052", $rfinal);
?>
