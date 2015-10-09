<?php

function getuseragent() 
{
     return isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : 'uknown';
}

?>