<?php
class Payload
{
	// Récupére tout les payload
	public function GetAllPayload($id = null)
	{
		if ($id == null)
        {
            $id = $_SESSION['id'];
        }

        $owner = Account::GetUser($id)['fuckkey'];


		return $GLOBALS['DB']->GetContent("payload", ["payload_owner" => $owner], "OR payload_owner = 'kPanel'");

	}

	public function GetFromPayload($id)
	{
			return $GLOBALS['DB']->GetContent('payload', ['id' => $id])[0];
	}

	public function IsOwner($owner = null, $id) {
		if ($owner == null)
		{
			$owner = $_SESSION['id'];
		}

		$tocheck = Payload::GetFromPayload($id)['payload_owner'];

		$ownername = Account::GetUser($owner)['fuckkey'];

		if ($tocheck == $ownername) {
			return true;
		} else {
			return false;
		}

	}

	public function GetAllOwnedPayload($id = null)
	{
		if ($id == null)
        {
            $id = $_SESSION['id'];
        }

        $owner = Account::GetUser($id)['fuckkey'];


		return $GLOBALS['DB']->GetContent("payload", ["payload_owner" => $owner]);

	}

	public function CountOwnedPayloadAPI($username)
	{

		$owner = Account::GetIdByUsername($username);
		$owner = Account::GetKey($owner);

		return $GLOBALS['DB']->Count("payload", ["payload_owner" => $owner]);

	}

	public function GetAllPayloadAdmin()
	{
		$owner = "yay";
		return $GLOBALS['DB']->GetContent("payload", ["glol" => $owner]);
	}

	public function GetShared()
	{

        $owner = Account::GetUser($id)['username'];


		return $GLOBALS['DB']->GetContent("payload", ["payload_owner" => 'Shared']);
		//$GLOBALS['DB']->GetContent("payload", ["payload_owner" => 'Shared']);

	}

	// Supprime un payload
	public function DeletePayload($id)
	{
		$name = Payload::GetPayload($id)['payload_name'];
		return $GLOBALS['DB']->Delete("payload", ["id" => $id]);
        Logs::AddLogs("<p class='text-danger'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-close'></i>&nbsp;Le payload ".$name." à été supprimé</p>");
	}

	// Créer un payload
	public function CreatePayload($name, $content, $owner, $side)
	{

		if ($id == null)
        {
            $id = $_SESSION['id'];
        }

		$GLOBALS['DB']->Insert("payload", ["payload_name" => $name, "payload_content" => $content, "payload_owner" => $owner, "payload_side" => $side]);
        Logs::AddLogs("<p class='text-primary'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-plus'></i>&nbsp;Un nouveau payload à été créer : ".$name."</p>");

        return "success";
	}

	// Edite un payload
	public function EditPayload($id, $name, $content, $side)
	{
		$GLOBALS['DB']->Update("payload", ["id" => $id], ["payload_name" => $name, "payload_content" => $content, "payload_side" => $side]);
	}

	// Récupére un payload
	public function GetPayload($id)
	{
		return $GLOBALS['DB']->GetContent("payload", ["id" => $id])[0];
	}
}
?>
