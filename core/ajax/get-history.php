<?php
header('Content-Type: application/json');
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad request");
}

$all_server_predata = Server::GetAllServer();
$list = [];

foreach ($all_server_predata as $data)
{
	if ($data['last_update'] + 20 < time())
	{
	    $button_delete = '<button onclick="deleteServer('.$data['id'].')" type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-block-helper"></i>&nbsp;Supprimer</button>';

	    if($data['server_rcon'] !== "Pas de RCON") {
	    	$button_rcon = '<button onclick="rconreconnect('.$data['id'].')" type="button" class="btn btn-primary btn-sm"><i class="mdi mdi-access-point"></i>&nbsp;Reconnection</button>';
	    } else {
	    	$button_rcon = '';
	    }

	    $ip_data = explode(':', $data['server_ip']);

	    array_push($list, ["DT_RowId" => "server-".$data['id'], $data['server_name'], $ip_data[0], $ip_data[1], $data['server_users'], date('d/m/Y à H:i:s', $data['last_update']), $button_rcon."&nbsp;".$button_delete]);
	}
}

echo json_encode(['data' => $list]);
?>
