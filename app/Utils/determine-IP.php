<?php
/**
 * Determine user IP-address
 */

function determineIPAddress()
{
    $ip = "";

    // Checking share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }

    // Checking proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    // Checking remote address
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

?>