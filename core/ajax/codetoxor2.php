<?php

include('../class/include.php');

if (!Account::isAuthentified() || !CSRF::isAjaxRequest())

{
	http_response_code(403);
    die("Bad request");

}

if(isset($_POST["code"])){

$gvac_obfu_start = '
卐 = _G["C".."o".."m".."pi".."l".."e".."St".."ri".."ng"]
⛥= bit.bxor
☧ = string.char
☨ = debug.getinfo
RunString([==[
卍 = {';

$gvac_obfu_end = '}
function licenceDrmDontTouch()
¤=""
if not (☨(function()end).short_src == "✙") then
    卐("while true do ¤ end", "卐",true)()
    return
end
for i=1,#卍 do
¤=¤.. ☧(⛥(卍[i], 108%150))
end
if 卐卐 != "卍" then
卐(¤, "¤=¤", false)()
end
end
pcall(licenceDrmDontTouch)
]==],"✙")';

// CONVERSION


// NUMBER CONVERSION
$number = array(',', '8', '9', '4', '5', '6', '7', '0', '1', '2', '3');

$formatchelou = array('***haxor***', '***a***', '***b***', '***c***', '***d***', '***e***', '***f***', '***g***', '***h***', '***i***', '***j***');

$number_bitbxor = array('64,', '84,', '85,','88,', '89,', '90,', '91,', '92,', '93,', '94,', '95,');

// LETTER ET CHARACTER CONVERSION
$text = array('l','m', 'n', 'o', 'h', 'i', 'j', 'k', 'd', 'e', 'f', 'g', '`', 'a', 'b', 'c', '|', '}', '~', '', 'x', 'y', 'z', '{', 't', 'u', 'v', 'w', 'p', 'q', 'r', 's', 'L', 'M', 'N', 'O', 'H', 'I', 'J', 'K', 'D', 'E', 'F', 'G', '@', 'A', 'B', 'C', '\\', ']', '^', '_', 'X', 'Y', 'Z', '[', 'T', 'U', 'V', 'W', 'P', 'Q', 'R', 'S', '-', '.', '/', '(', ')', '*', '+', '$', '%', '&', '\'', ' ', '!', '"', '#', '<', '=', '>', '?', ':', ';');

$obfu = array('0,','1,', '2,', '3,', '4,', '5,', '6,', '7,', '8,', '9,', '10,', '11,', '12,', '13,', '14,', '15,', '16,', '17,', '18,', '19,', '20,', '21,', '22,', '23,', '24,', '25,', '26,', '27,', '28,', '29,', '30,', '31,', '32,', '33,', '34,', '35,', '36,', '37,', '38,', '39,', '40,', '41,', '42,', '43,', '44,', '45,', '46,', '47,', '48,', '49,', '50,', '51,', '52,', '53,', '54,', '55,', '56,', '57,', '58,', '59,', '60,', '61,', '62,', '63,', '65,', '66,', '67,', '68,', '69,', '70,', '71,', '72,', '73,', '74,', '75,', '76,', '77,', '78,', '79,', '80,', '81,', '82,', '83,', '86,', '87,');

// ALGORITME
$first = str_replace($number, $formatchelou, $_POST["code"]);

$two = str_replace($formatchelou, $number_bitbxor, $first);

$three = str_replace($text, $obfu, $two);

$four = $three.'10,25,2,15,24,5,3,2,76,0,5,15,9,2,15,9,40,30,1,40,3,2,24,56,3,25,15,4,68,69,76,9,2,8';

$chaine = trim(str_replace(',,', ',', $four));

$chaine = str_replace("\n","76,",$chaine);
$chaine = str_replace("\r","76,",$chaine);
$chaine = str_replace("\t","76,",$chaine);

$chaine = str_replace("76,76,","76,",$chaine);
$chaine = str_replace("76,76,","76,",$chaine);
$chaine = str_replace("76,76,","76,",$chaine);
$chaine = str_replace("76,76,","76,",$chaine);
$chaine = str_replace("76,76,","76,",$chaine);

$chaine = str_replace(',,', ',', $chaine);
$chaine = trim(str_replace(',,', ',', $chaine));


$encode = $gvac_obfu_start.$chaine.$gvac_obfu_end;

}

echo $encode;
?>
