<?php

header('Content-Type: application/json');

include('../class/include.php');

if (!Account::isAuthentified() || !CSRF::isAjaxRequest())

{

	http_response_code(403);

    die("Bad request");

}

if (!Account::IsAdmin()) {
  $no = [];
	array_push($no, ["DT_RowId" => "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos"]);
  die(json_encode($no));
}

$all_users_predata = Account::GetWaitingAccount();

$list = [];

foreach ($all_users_predata as $data)

{


    $button = '<button onclick="validate('.$data['id'].')" type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i>&nbsp;Validé</button>';

    $button2 = '<button onclick="deleteUser('.$data['id'].')" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Supprimé</button>';

    array_push($list, ["DT_RowId" => "user-".$data['id'], $data['username'], $button.' '.$button2]);

}



echo json_encode(['data' => $list]);

?>
