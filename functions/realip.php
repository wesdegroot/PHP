<?php

function realip($ip)
{
  if(preg_match("/^((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])$/", $ip))
  {
    return true;
  }
  else
  {
    return false;
  }
}

?>