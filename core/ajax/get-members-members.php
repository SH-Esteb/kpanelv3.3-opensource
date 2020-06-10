<?php
include('../class/include.php');
if (!Account::isAuthentified() && !CSRF::isAjaxRequest())
{
	http_response_code(403);
    die("Bad request");
}

$all_members_predata = Account::GetAllMembers();

if(empty($all_members_predata)) {
	die("<br><div class=\"text-center\">Aucun utilisateur</div>");
}



foreach ($all_members_predata as $data) {

	$pp = $data['discord_avatar'];
	$did = $data['discord_id'];
	$fulllink = "https://cdn.discordapp.com/avatars/$did/$pp";

if (!$pp) {
	$fulllink = "https://cdn.pixabay.com/photo/2017/07/18/23/23/user-2517433_960_720.png";
}

?>
<div class="col-sm-4">
<div class="card" style="width: 18rem; ">
  <img src="<?php echo $fulllink ; ?>" class="card-img-top" alt="<?php echo $data['username']; ?>">
  <div class="card-body">
    <h5 class="card-title text-center" style="color:white; font-size: 1.5rem;"><?php echo $data['username']; ?></h5>
  </div>
</div>
</div>

<?php }

?>
