<?php
include 'core/class/include.php';
function reloadString($length = 100) {
      $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZs';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
    return $randomString;
}

function str_find($str, $target)
{
    if (strpos($str, $target) !== false) {
        return "true";
    }
    return "false";
}

function contains($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

define('OAUTH2_CLIENT_ID', '716635785851437137');
define('OAUTH2_CLIENT_SECRET', '6NWaPoCJwiHLqfBauP1OgsFNaHGKibrM');
$authorizeURL = 'https://discord.com/api/oauth2/authorize';
$tokenURL = 'https://discord.com/api/oauth2/token';
$apiURLBase = 'https://discord.com/api/users/@me';

if(get('code')) {
  if(strlen(get('code')) < 29) {
    die("Erreur dans la matrice, code \"".get('code')."\" invalide");
  }

  $token = apiRequest($tokenURL, array(
    "grant_type" => "authorization_code",
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'redirect_uri' => 'https://kpanel.cz/login',
    'code' => get('code')
  ));
  if ($token->scope !== "identify guilds") {
    echo "Erreur dans votre requete: Un ou plusieurs scopes sont manquant, veuillez reessayez.";
    echo "<br>Si vous pensez qu'il s'agit d'une erreur, veuillez nous contactez sur <a href='https://discord.gg/Q6mJwR2'>https://discord.gg/Q6mJwR2</a>";
    session_unset();
    session_destroy();
    die();
  }



  $logout_token = $token->access_token;
  $_SESSION['access_token'] = $token->access_token;


//  header('Location: ' . $_SERVER['PHP_SELF']);
}

if(session('access_token')) {
  $user = apiRequest($apiURLBase);
  $_SESSION['discord_socket'] = $user;
  $test = apiRequest("https://discord.com/api/users/@me/guilds");
  $collabo =  json_encode($test);

  if (strpos($collabo, '690929323812716555') !== false) {
    if (!isset($_SESSION['bad'])) {
      $_SESSION['bad'] = 'lkpanel';
      header('Location: /home/error.php?discord=LKpanel');
    }
  }
  else if (strpos($collabo, '674717821334454272') !== false) {
    if (!isset($_SESSION['bad'])) {
      $_SESSION['bad'] = 'enigma';
      header('Location: /home/error.php?discord=Enigma Community');
    }
  }
  else if (strpos($collabo, '698992890336247879') !== false) {
    if (!isset($_SESSION['bad'])) {
      $_SESSION['bad'] = 'cipher';
      header('Location: /home/error.php?discord=Cipher Panel');
    }
  }
  else if (strpos($collabo, '685380536667078706') !== false) {
    if (!isset($_SESSION['bad'])) {
      $_SESSION['bad'] = 'smart';
      header('Location: /home/error.php?discord=Smart OverWrite');
    }
  }
  else if (strpos($collabo, '609886971665449010') !== false) {
    if (!isset($_SESSION['bad'])) {
      $_SESSION['bad'] = 'omega';
      header('Location: /home/error.php?discord=Omega Project');
    }
  }
  else if (strpos($collabo, '702662259557793844') !== false) {
    if (!isset($_SESSION['bad'])) {
      $_SESSION['bad'] = 'infinity';
      header('Location: /home/error.php?discord=Infinity Panel');
    }
  }
  else if (strpos($collabo, '713437213924392991') !== false) {
    if (!isset($_SESSION['bad'])) {
      $_SESSION['bad'] = 'sylent';
      header('Location: /home/error.php?discord=Sylent Panel');
    }
  }else{



       unset($_SESSION['bad']);

       $is_exist = $GLOBALS['DB']->Count("users",["discord_id" => $user->id]);

       if ($is_exist == 1){

        $GLOBALS['DB']->Update("users",[
            "discord_id" => $user->id
          ],[
            "discord_avatar" => $user->avatar,
            "username" => $user->username
        ]);

        if(strpos($collabo, '684436636314238988')){
       	$_SESSION["id"] = $GLOBALS["DB"]->GetContent("users",["discord_id" => $user->id])[0]["id"];
       	header("Location: ./dashboard");
        }else{
           if (!isset($_SESSION['bads'])) {
                $_SESSION['bads'] = 'not_in';
                header('Location: https://kpanel.cz/home/error.php?discord=not_in');
           }
        }
       }else{
          $GLOBALS['DB']->Insert("users",[
            "discord_id" => $user->id,
            "discord_avatar" => $user->avatar,
            "username" => $user->username,
            "role" => "0",
            "active" => "1",
            "ban" => "0",
            "fuckkey" => reloadString(10),
            "validationtoken" => reloadString(35)
          ]);

          if(strpos($collabo, '684436636314238988')) {
            $_SESSION["id"] = $GLOBALS["DB"]->GetContent("users",["discord_id" => $user->id])[0]["id"];
       	    header("Location: ./dashboard");
          }else{
             if (!isset($_SESSION['bads'])) {
                  $_SESSION['bads'] = 'not_in';
                  header('Location: https://kpanel.cz/home/error.php?discord=not_in');
             }
          }

       }

  }



}else{
  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => 'https://kpanel.cz/login',
    'response_type' => 'code',
    'scope' => 'identify guilds'
  );
  header('Location: https://discord.com/api/oauth2/authorize' . '?' . http_build_query($params));
}

function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $response = curl_exec($ch);
  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  $headers[] = 'Accept: application/json';
  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec($ch);
  return json_decode($response);
}

function get($key, $default=NULL) {
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default=NULL) {
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}
?>
