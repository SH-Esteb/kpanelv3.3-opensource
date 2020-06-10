<?php
include('../class/include.php');
if (!Account::isAuthentified() && !CSRF::isAjaxRequest())
{
    die("Bad request");
}

$logs = Logs::GetLastLogs(10);
if (count($logs) == 0)
{
	echo "<p class='text-center'>Aucune log récentes.</p>";
}
else
{
	foreach($logs as $log)
	{
		echo $log['content'];
	}
}
?>