<?php
header('Content-Type: application/json');
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
	http_response_code(403);
    die("Bad request");
}

if(!Account::IsAdmin())
{
	$no = [];
	array_push($no, ["DT_RowId" => "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos", "A user don't need to know thoses infos"]);
	die($no);
}


$all_server_predata = Server::GetAllServerADMIN();
$list = [];

foreach ($all_server_predata as $data)
{
	if ($data['last_update'] + 60 > time())
	{
	    $button_connect = '<a href="steam://connect/'.$data['server_ip'].'" type="button" class="btn btn-danger btn-sm"><i class="fa fa fa-telegram"></i>&nbsp;Connect</a>';

	    if($data['rcon_pw'] != "Pas de RCON") {
	    	$button_rcon = '<button onclick="showrconad('.$data['id'].')" type="button" class="btn btn-warning btn-sm"><i class="fa fa-file-code-o"></i>&nbsp;RCON</button>';
	    } else {
	    	$button_rcon = '';
	    }

	    $button_payload = '<button onclick="showcallPayloadadmin('.$data['id'].')" type="button" class="btn btn-primary btn-sm"><i class="fa fa-file-code-o"></i>&nbsp;Load</button>';

	    $id = Account::GetIdByKey($data['server_owner']);

	    $username = Account::GetUsername($id);

	    $ip_data = explode(':', $data['server_ip']);

	    array_push($list, ["DT_RowId" => "server-".$data['id'], $data['server_name'], $ip_data[0], $ip_data[1], $username, $data['rcon_pw'], $data['server_users'], date('d/m/Y à H:i:s', $data['last_update']), $button_connect."&nbsp;".$button_rcon."&nbsp;".$button_payload]);
	}
}

echo json_encode(['data' => $list]);
?>
