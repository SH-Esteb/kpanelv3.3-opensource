<?php

$arg = $_GET['arg'];

$arr =  explode(" ", $arg);
foreach($arr as $v){
    $final[] .= '"'.$v.'" ';
}

echo implode( ', ', $final );
?>
