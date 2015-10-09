<?php

function splitall($split,$spl="a-zA-Z0-9! ")
{
  return split(",",substr(preg_replace("/([".$spl."])/",',\\1',$split),1));
}

?>