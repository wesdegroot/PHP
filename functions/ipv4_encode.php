<?php

function ipv4_encode($ip) {
    $ip=explode(".",$ip);
    return chr($ip[0]).chr($ip[1]).chr($ip[2]).chr($ip[3]);
}

?>