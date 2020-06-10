<?php
ini_set('session.cookie_httponly', 1);
session_start();

class Account
{
    // S'authentifie
    public function Auth($username, $password)
    {
        if (Account::isUsernameExist($username))
        {
            $user = $GLOBALS['DB']->GetContent("users", ["username" => $username])[0];
            if(Account::isPasswordTrue($user, $password))
            {
                $_SESSION['id'] = $user["id"];
                return true;
            }
        }
        return false;
    }

    // Vérifie si l'id d'un utilisateur existe
    public function CheckID($id)
    {
        if ($GLOBALS['DB']->Count('users', ['id' => $id]) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Vérifie si l'id d'un utilisateur existe
    public function CheckKey($key)
    {
        if ($GLOBALS['DB']->Count('users', ['fuckkey' => $key]) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function isFuckKeyExist($key)
    {
        if ($GLOBALS['DB']->Count("users", ["fuckkey" => $key]) != 0)
        {
            return true;
        }
        return false;
    }

    public function setRole($user_id, $role)
    {
        $username = Account::GetUser($user_id)['username'];
        $GLOBALS['DB']->Update('users', ['id' => $user_id], ['role' => $role]);
    }

    public function GetAllAdmin()
    {
        return $GLOBALS['DB']->GetContent("users", ['role' => 1]);
    }
    public function GetAllMembers()
    {
        return $GLOBALS['DB']->GetContent("users", ['role' => 0,'ban' => 0]);
    }
    public function GetAllBanned()
    {
        return $GLOBALS['DB']->GetContent("users", ['role' => 0, 'ban' => 1]);
    }

    public function setPP($pp)
    {

        function contains($str, array $arr)
        {
            foreach($arr as $a) {
                if (stripos($str,$a) !== false) return true;
            }
            return false;
        }

        $allowed_ext = array(
            '.png',
            '.jpg',
            '.jpeg',
            '.webp',
            '.gif'
        );

        if(empty($pp)) {
            return "blank";
        }

        $user_id = $_SESSION['id'];
        if (contains($pp, $allowed_ext)) {
            $GLOBALS['DB']->Update('users', ['id' => $user_id], ['pp' => $pp]);
            return "success";
        } else {
            return "extnotgood";
        }
    }


    public function IsAdmin($user_id = null)
    {
        if ($user_id == null)
        {
            $user_id = $_SESSION['id'];
        }

        $therole = Account::GetUser($user_id)['role'];
        if($therole == 1) {
            return true;
        } else if($therole == 2) {
            return true;
        }
        else {
            return false;
        }
    }

    public function IsActive($user_id = null)
    {
        if ($user_id == null)
        {
            $user_id = $_SESSION['id'];
        }

        $activity = Account::GetUser($user_id)['active'];
        if($activity == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function isTokenExist($token)
    {
        if ($GLOBALS['DB']->Count("users", ["validationtoken" => $token]) != 0)
        {
            return true;
        }
        return false;
    }

    public function IsBanned($user_id = null)
    {
        if ($user_id == null)
        {
            $user_id = $_SESSION['id'];
        }

        $banstate = Account::GetUser($user_id)['ban'];
        if($banstate == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function BanHim($user_id) {
        $GLOBALS['DB']->Update('users', ['id' => $user_id], ['ban' => 1]);
        return "success";
    }

    public function UnBan($user_id) {
        return $GLOBALS['DB']->Update('users', ['id' => $user_id], ['ban' => 0]);
    }

    public function GetIdByKey($key)
    {
        return $GLOBALS['DB']->GetContent("users", ["fuckkey" => $key])[0]['id'];
    }

    public function GetIdByToken($token)
    {
        if (Account::isTokenExist($token))
        {
            return $GLOBALS['DB']->GetContent("users", ["validationtoken" => $token])[0]['id'];
        }
        else
        {
            return false;
        }
    }

    public function GetKeyById($id = null)
    {
        if ($id == null)
        {
            $id = $_SESSION['id'];
        }
        return $GLOBALS['DB']->GetContent("users", ["id" => $id])[0]['fuckkey'];
    }

    public function GetRole($user_id = null)
    {
        if ($user_id == null)
        {
            $user_id = $_SESSION['id'];
        }

        $therole = Account::GetUser($user_id)['role'];
        if($therole == 1) {
            return "Administrateur";
        }
        elseif($therole == 0) {
            return "Utilisateur";
        }
        else {
            return "invalid";
        }
    }

    public function GetKey($id = null)
    {
        if ($id == null)
        {
            $id = $_SESSION['id'];
        }
        return Account::GetUser($id)['fuckkey'];
    }

    public function GetMKey($id = null)
    {
        if ($id == null)
        {
            $id = $_SESSION['id'];
        }
        return Account::GetUser($id)['validationtoken'];
    }

    public function ChangeFuckKey($id)
    {
        function reloadString($length = 100) {

            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZs';

            $charactersLength = strlen($characters);

            $randomString = '';

            for ($i = 0; $i < $length; $i++) {

                $randomString .= $characters[rand(0, $charactersLength - 1)];

            }

            return $randomString;

        }
        $newkey = reloadString(10);
        $GLOBALS['DB']->Update('users', ['id' => $id], ['fuckkey' => $newkey]);
        return success;
    }

    // Vérifie si l'utilisateur et authentifier
    public function isAuthentified()
    {
         return isset($_SESSION['id']);
    }

    // Récupére le nom d'utilisateur
    public function GetUsername($id = null)
    {
        if ($id == null)
        {
            $id = $_SESSION['id'];
        }

        $username = Account::GetUser($id)['username'];
        return $username;
    }

    public function GetPP($id = null)
    {
        if ($id == null)
        {
            $id = $_SESSION['id'];
        }

        $pp = Account::GetUser($id)['discord_avatar'];
        $did = Account::GetUser($id)['discord_id'];
        return "https://cdn.discordapp.com/avatars/$did/$pp";
    }

    public function GetPPChat($id = null)
    {
      if (isset(Account::GetUserChat($id)['discord_avatar'])) {
        $pp = Account::GetUserChat($id)['discord_avatar'];
        $did = Account::GetUserChat($id)['discord_id'];
        $ppchat = "https://cdn.discordapp.com/avatars/".$did."/".$pp;
      } else {
        $ppchat = "https://cdn.pixabay.com/photo/2017/07/18/23/23/user-2517433_960_720.png";
      }
        return $ppchat;
    }

    // Supprime un utilisateur grace à son id
    public function DeleteUser($user_id)
    {
        $username = Account::GetUser($user_id)['username'];
        $GLOBALS['DB']->Delete('users', ['id' => $user_id]);
        Logs::AddLogs("<p class='text-danger'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-close'></i>&nbsp;L'utilisateur ".$username." à été supprimé</p>");
    }

    // Récupére un utilisateur grace à son id
    public function GetUser($user_id = null)
    {
        if ($user_id == null)
        {
            $user_id = $_SESSION['id'];
        }

        return $GLOBALS['DB']->GetContent('users', ['id' => $user_id])[0];
    }

    public function GetUserChat($user_id = null)
    {
        return $GLOBALS['DB']->GetContent('users', ['id' => $user_id])[0];
    }

    // Change le mot de passe de l'utilisateur actuelle
    public function ChangePassword($old_password, $new_password, $confirm_new_password)
    {
        $user = $GLOBALS['DB']->GetContent('users', ['id' => $_SESSION['id']])[0];
        if (Account::isPasswordTrue($user, $old_password))
        {
               if ($new_password == $confirm_new_password)
               {
                   	$salt = sha1(dechex(mt_rand(0, 2147483647)).dechex(mt_rand(0, 2147483647)));
		            $hash_password = $new_password.$salt;
		        	for($i = 0; $i<500; $i++)
            		{
            		   $hash_password = hash('sha256', $hash_password);
            		}
		            $password_protection = $hash_password.":".$salt;

                    $GLOBALS['DB']->Update('users', ['id' => $_SESSION['id']], ['password' => $password_protection]);

                    return "success";
               }
               else {
                   return "Les nouveau mot de passe ne corresponde pas.";
               }
        }
        else {
            return "L'ancien mot de passe n'est pas valide.";
        }
    }

    // Vérifie si un nom d'utilisateur existe
    public function isUsernameExist($username)
    {
        if ($GLOBALS['DB']->Count("users", ["username" => $username]) != 0)
        {
            return true;
        }
        return false;
    }

    public function isDidExist($discord_id)
    {
        if ($GLOBALS['DB']->Count("users", ["discord_id" => $discord_id]) != 0)
        {
            return true;
        }
        return false;
    }

    // Retourne un id grâce à un username
    public function GetIdByUsername($username)
    {
        if (Account::isUsernameExist($username))
        {
            return $GLOBALS['DB']->GetContent("users", ["username" => $username])[0]['id'];
        }
        else
        {
            return false;
        }
    }

    public function GetIdByDid($discord_id)
    {
        if (Account::isDidExist($discord_id))
        {
            return $GLOBALS['DB']->GetContent("users", ["discord_id" => $discord_id])[0]['id'];
        }
        else
        {
            return false;
        }
    }

    // Vérifie le mot de passe grace au Salt
    private function isPasswordTrue($user, $password)
    {
    	$password_check = explode(":", $user["password"]);
    	$password_to_check = $password.$password_check[1];
    	for($i = 0; $i<500; $i++)
		{
		   $password_to_check = hash('sha256', $password_to_check);
		}

		if ($password_check[0] == $password_to_check)
		{
		    return true;
		}
		return false;
    }

    // Créer un utilisateur
    public function CreateUser($username, $password, $confirm_password, $mail)
    {
        function reloadString($length = 100) {

            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZs';

            $charactersLength = strlen($characters);

            $randomString = '';

            for ($i = 0; $i < $length; $i++) {

                $randomString .= $characters[rand(0, $charactersLength - 1)];

            }

            return $randomString;

        }

		if ($password != $confirm_password)
		{
			return "Les mot de passe ne conresponde pas.";
		}
		else if (Account::isUsernameExist($username))
		{
			return "Le pseudo demandé et déjà en cours d'utilisation.";
		}

       	$salt = sha1(dechex(mt_rand(0, 2147483647)).dechex(mt_rand(0, 2147483647)));
        $hash_password = $password.$salt;
    	for($i = 0; $i<500; $i++)
		{
		   $hash_password = hash('sha256', $hash_password);
		}
        $password_protection = $hash_password.":".$salt;

        $fuckkey = reloadString(10);

        $masterkey = reloadString(30);

		$GLOBALS['DB']->Insert("users", ["username" => $username, "password" => $password_protection, "fuckkey" => $fuckkey, "role" => 0, "pp" => "https://kpanel.cz/imgs/kalysianewpart.png", "mail" => $mail, "validationtoken" => $masterkey, "active" => 1, "ban" => 0]);

        Logs::AddLogs("<p class='text-primary'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-plus'></i>&nbsp;Le nouvelle utilisateur ".$username." à été créer</p>");

        return "success";
    }

    public function RegisterUser($username, $password, $confirm_password, $mail)
    {
        function reloadString($length = 100) {

            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZs';

            $charactersLength = strlen($characters);

            $randomString = '';

            for ($i = 0; $i < $length; $i++) {

                $randomString .= $characters[rand(0, $charactersLength - 1)];

            }

            return $randomString;

        }

        if ($password != $confirm_password)
        {
            return "Les mot de passe ne conresponde pas.";
        }
        else if (Account::isUsernameExist($username))
        {
            return "Le pseudo demandé et déjà en cours d'utilisation.";
        }

        $salt = sha1(dechex(mt_rand(0, 2147483647)).dechex(mt_rand(0, 2147483647)));
        $hash_password = $password.$salt;
        for($i = 0; $i<500; $i++)
        {
           $hash_password = hash('sha256', $hash_password);
        }
        $password_protection = $hash_password.":".$salt;

        $fuckkey = reloadString(10);

        $masterkey = reloadString(30);

        $GLOBALS['DB']->Insert("users", ["username" => $username, "password" => $password_protection, "fuckkey" => $fuckkey, "role" => 0, "pp" => "https://kpanel.cz/imgs/kalysianewpart.png", "mail" => $mail, "validationtoken" => $masterkey, "active" => 0, "ban" => 0]);

        Logs::AddLogs("<p class='text-primary'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-plus'></i>&nbsp;Le nouvelle utilisateur ".$username." a été mis en attente (Register).</p>");

        $to_email = $mail;
        $subject = 'Mail Validation - kPanel';
        $message = 'Validation Email

        Pour validé votre compte, merci de vous rendre sur le lien:
        https://kpanel.cz/validate.php?token='.$masterkey.'

        Merci.

        - kPanel V3';
        $headers = 'From: noreply@kpanel.cz';
        mail($to_email,$subject,$message,$headers);

        return "success";
    }

    public function Validate($id)
    {
        $username = Account::GetUsername($id);
        $GLOBALS['DB']->Update('users', ['id' => $id], ['active' => '1']);
        Logs::AddLogs("<p class='text-primary'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-plus'></i>&nbsp;Le nouvel utilisateur ".$username." a été validé</p>");
    }

    public function ValidateE($token)
    {
        $id = Account::GetIdByToken($token);
        $usnam = Account::GetUsername($id);
        $GLOBALS['DB']->Update('users', ['validationtoken' => $token], ['active' => '1']);
        Logs::AddLogs("<p class='text-primary'>[".date('d/m/Y à H:i:s', time())."]&nbsp;<i class='fa fa-plus'></i>&nbsp;Le nouvel utilisateur ".$usnam." à été validé par Email</p>");
    }

    public function GetWaitingAccount()
    {
        return $GLOBALS['DB']->GetContent("users", ['active' => '0']);

    }

    public function IsUserNameTooken($username)
    {
        if ($GLOBALS['DB']->Count("users", ["username" => $username]) != 0)
        {
            return true;
        }
        return false;
    }

    public function IsEmailTooken($mail)
    {
        if ($GLOBALS['DB']->Count("users", ["mail" => $mail]) != 0)
        {
            return true;
        }
        return false;
    }

    // Déconnecte l'utilisateur actuelle
    public function Disconnect()
    {
        session_unset();
        session_destroy();
    }

    // Récupére le nombre total de Compte
    public function GetAccountNbr()
    {
        return $GLOBALS['DB']->Count("users");
    }

    // Récupére tous les compte
    public function GetAllAccount()
    {
        return $GLOBALS['DB']->GetContent("users");
    }



    // Redéfinie l'username à un utilisateur
    public function SetUsername($id, $username)
    {
        $GLOBALS['DB']->Update('users', ['id' => $id], ['username' => $username]);
    }

    public function SetRoleColor($id = null, $color) {
      if ($id == null) {
        $id = $_SESSION['id'];
      }

      $GLOBALS['DB']->Update('users', ['id' => $id], ['rolecolor' => $color]);
      return "success";
    }

    public function GetRoleColor($id = null) {
      if ($id == null) {
        $id = $_SESSION['id'];
      }

      $color = Account::GetUser($id)['rolecolor'];
      if ($color == "blue") {
        return "#00afff";
      }
      else if ($color == "purple") {
        return "#9000ff";
      }
      else if ($color == "red") {
        return "#ff0000";
      }
      else if ($color == "green") {
        return "#2bff00";
      }
      else if ($color == "orange") {
        return "#ff7700";
      }
      else {
        return "#00afff";
      }

    }

    public function GetRoleColorFire($id = null) {
      if ($id == null) {
        $id = $_SESSION['id'];
      }

      $color = Account::GetUser($id)['rolecolor'];
      if ($color == "blue") {
        return "./imgs/fire_blue.gif";
      }
      else if ($color == "purple") {
        return "./imgs/fire_purple.gif";
      }
      else if ($color == "red") {
        return "./imgs/fire_red.gif";
      }
      else if ($color == "green") {
        return "./imgs/fire_green.gif";
      }
      else if ($color == "orange") {
        return "./imgs/fire_orange.gif";
      }
      else {
        return "./imgs/fire_blue.gif";
      }

    }
}
?>
