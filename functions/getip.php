<?php

function getip($ra = false)
{
  if ($ra == false)
  {
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif (isset($_SERVER['HTTP_PROXY_CONNECTION'])) { 
      return $_SERVER['HTTP_PROXY_CONNECTION'];
    }
    elseif (isset($_SERVER['HTTP_VIA'])) { 
      return $_SERVER['HTTP_VIA'];
    } 
    elseif (isset($_SERVER['HTTP_CLIENT_IP'])) { 
      return $_SERVER['HTTP_CLIENT_IP'];
    } 
    else
    {
      if(isset($_SERVER['REMOTE_ADDR']))
      {
        return $_SERVER['REMOTE_ADDR'];
      }
      else
      {
        return "00.00.00.000";
      }
    }
  }
  else
  {
    if(isset($_SERVER['REMOTE_ADDR']))
    {
      return $_SERVER['REMOTE_ADDR'];
    }
    else
    {
      return "00.00.00.000";
    }
  }
}


?>