<?php

include('../class/include.php');




$obfukey = 108;



    $code = $_POST["code"];



    if(preg_match("#{#", $_POST["code"])){

        $code = explode('{', $code);

        $code = $code[1];

    }

    if(preg_match("#}#", $_POST["code"])){

        $code = explode('}', $code);

        $code = $code[0];

    }

    if(preg_match("#RunningDuck#", $_POST["coding"])){
        $obfukey = 97;
    }
    if(preg_match("#LVAC#", $_POST["coding"])){
        $obfukey = 97;
    }

    if(preg_match("#RunningDuck#", $_POST["code"])){
        $obfukey = 97;
    }
    if(preg_match("#kPanel#", $_POST["code"])){
        $obfukey = 2317;
    }
    if(preg_match("#Sheitan#", $_POST["code"])){
        $obfukey = 2317;
    }


    if(preg_match("#AE#", $_POST["code"])){
        $obfukey = 150;
    }

    if(preg_match("#rhpic#", $_POST["code"])){

        $obfukey = 666;

    }

    if(preg_match("#ciphr#", $_POST["code"])){

        $obfukey = 666;

    }    $encodetbl = $code;

    if(preg_match("#enccodetbl#", $_POST["coding"])){
        $obfukey = 102;
    }


    $str_cut = explode(',', $encodetbl);



    foreach ($str_cut as $deobfusque) {

        $x= $deobfusque;

        $y=$obfukey;

        echo chr($x ^ $y);

    }

?>
