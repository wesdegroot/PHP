<?php

function ipv4_decode($ip) {
    return ord(substr($ip,0,1)).'.'.ord(substr($ip,1,1)).'.'.ord(substr($ip,2,1)).'.'.ord(substr($ip,3,1));
}

?>