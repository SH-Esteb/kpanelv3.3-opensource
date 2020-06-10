<?php
header('Content-Type: application/json');
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad request");
}

if (!Account::IsAdmin()) {
  $no = [];
  array_push($no, ["DT_RowId" => "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos"]);
  die(json_encode($no));
}

$all_users_predata = Account::GetAllAccount();
$list = [];

foreach ($all_users_predata as $data)

{
	if ($data['active'] == 1) {
	$himrole = Account::GetRole($data['id']);
	$fuckkey = Account::GetKey($data['id']);
  $rolecolor = Account::GetRoleColor($data['id']);
  $rolecolorlink = Account::GetRoleColorFire($data['id']);

    if ($data['id'] != 72) {
    $button = '<button onclick="deleteUser('.$data['id'].')" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Supprimer</button>';

   	$setrole = '  <button onclick="showrole('.$data['id'].')" type="button" class="btn btn-info btn-sm"><i class="fa fa-user"></i>&nbsp;Role</button>';

    if ($data['ban'] == 0) {
    $ban = '  <button onclick="ban('.$data['id'].')" type="button" class="btn btn-danger btn-sm"><i class="fa fa-user"></i>&nbsp;Bannir</button>';
    } else {
    $ban = '  <button onclick="deban('.$data['id'].')" type="button" class="btn btn-success btn-sm"><i class="fa fa-user"></i>&nbsp;Débannir</button>';
    }
  } else {
    $button = 'Ce membre est intouchable';
    $setrole = '';
    $himrole = '<span style="font-size: 12px; color: #000000; font-weight: bold; text-shadow: 0 0 5px '.$rolecolor.', 0 0 5px '.$rolecolor.'; background: url('.$rolecolorlink.') repeat scroll 0% 0% transparent;}">Gérant</span>';
    $fuckkey = '<span style="filter: blur(3px)"> XXXXXXXXXX </span>';
    $ban = '';
  }

  if ($data['id'] == 75) {
    $button = 'Tu touche t\'es mort';
    $setrole = '';
    $himrole = '<span style="font-size: 12px; color: #000000; font-weight: bold; text-shadow: 0 0 5px '.$rolecolor.', 0 0 5px '.$rolecolor.'; background: url('.$rolecolorlink.') repeat scroll 0% 0% transparent;}">Gérant</span>';
    $fuckkey = '<span style="filter: blur(3px)"> XXXXXXXXXX </span>';
    $ban = '';
  }

  if ($himrole == "Administrateur") {
    $himrole = '<span style="font-size: 12px; color: #000000; font-weight: bold; text-shadow: 0 0 5px '.$rolecolor.', 0 0 5px '.$rolecolor.'; background: url('.$rolecolorlink.') repeat scroll 0% 0% transparent;}">Administrateur</span>';
  }

    array_push($list, ["DT_RowId" => "user-".$data['id'], $data['username'], $himrole, $fuckkey, $button.$setrole.$resetkey.$ban]);
	}
}

echo json_encode(['data' => $list]);
?>
