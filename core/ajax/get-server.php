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
	if ($data['last_update'] + 60 > time())
	{
	    $button_payload = '<a href="./viewserver?id='.$data['id'].'" type="button" class="btn btn-info btn-lg"><i class="fa fa-file-code-o"></i>&nbsp;Gestion</button>';

	    $ip_data = explode(':', $data['server_ip']);

	    array_push($list, ["DT_RowId" => "server-".$data['id'], $data['server_name'], $ip_data[0], $ip_data[1], $data['server_rcon'], $data['server_users'], date('d/m/Y à H:i:s', $data['last_update']), "&nbsp;".$button_rcon."&nbsp;".$button_payload]);
	}
}

echo json_encode(['data' => $list]);
?>
