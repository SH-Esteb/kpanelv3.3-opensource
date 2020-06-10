<?php
include('../class/include.php');
if (!Account::isAuthentified() && !CSRF::isAjaxRequest())
{
	http_response_code(403);
    die("Bad request");
}


$chat = Chat::GetLastMessage(5);
if (count($chat) == 0)
{
	echo "<p class='text-center' style='color:white;'>Aucun message récent.</p>";
}
else
{
	foreach($chat as $chatc)
	{
		$id = $chatc['userid'];
		$theshownpp = Account::GetPPChat($id);
		$rolecolor = Account::GetRoleColor($id);
		$rolecolorlink = Account::GetRoleColorFire($id);

		if (Account::IsAdmin($id)) {
            $grade = '<span style="font-size: 12px; color: #000000; font-weight: bold; text-shadow: 0 0 5px '.$rolecolor.', 0 0 5px '.$rolecolor.'; background: url('.$rolecolorlink.') repeat scroll 0% 0% transparent;}">Administrateur</span>';
        } else {
            $grade = '<span id="grade" style="font-size: 12px;" class="badge badge-info">Utilisateur</span>';
		}
		if (!Account::GetUserChat($id)) {
			$grade = '<span id="grade" class="badge badge-warning">Bannie</span>';
		}
		echo "<div id=\"heya\" style=\"padding: 7px; font-size: 1rem; color:white; \">";
		echo "<img src=\"". $theshownpp ."\" alt=\"user-img\" width=\"36\" class=\"img-xs rounded-circle\">&nbsp;";
		echo utf8_decode($chatc['pseudo'])."&nbsp;".$grade." :" ;
		echo '<br>';
		echo $chatc['message'].$chatc['date'];
		echo '</div>';
	}
}
?>
