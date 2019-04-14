<?php

    function escape($string) {
        global $connection;
        return mysqli_real_escape_string($connection, $string);
    }

    function getToken($len) {

        $rand_str = md5(uniqid(mt_rand(), true));
        $base64_encode = base64_encode($rand_str);
        $modified_base64_encode = str_replace(array('+', '='), array('', ''), $base64_encode);
        $token = substr($modified_base64_encode, 0, $len);
        return $token;

    }

    


    
    function isValid($date){
        
    $dt =$date;
    $array = explode("-",$dt);

    $day = $array[1];
    $month = $array[2];
    $year = $array[0];

    if(!checkdate($month, $day, $year))
    {
    $msg2_dt = "Must be in m/d/y format";
    }
    else
    {
    $today = strtotime("now");
    if(strtotime($dt)<$today)
    $msg3_dt = "Date supplied is before present day";
    }
}


    