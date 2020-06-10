<?php

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 error_reporting(E_ERROR | E_WARNING | E_PARSE);

require 'SourceQuery/bootstrap.php';

use xPaw\SourceQuery\SourceQuery;

$code = 'ulx adduser Eradium superadmin';

// For the sake of this example
#Header( 'Content-Type: text/plain' );
#Header( 'X-Content-Type-Options: nosniff' );

// Edit this ->
define( 'SQ_SERVER_ADDR', "164.132.9.216" );
define( 'SQ_SERVER_PORT', 27070 );
define( 'SQ_TIMEOUT',     1 );
define( 'SQ_ENGINE',      SourceQuery::SOURCE );
// Edit this <-

$Query = new SourceQuery();

try
{
    $Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
    
    $Query->SetRconPassword( "cc6853e4e7" );
    
    var_dump( $Query->Rcon( $code ) );
}
catch( Exception $e )
{
    echo $e->getMessage();
}

$Query->Disconnect();