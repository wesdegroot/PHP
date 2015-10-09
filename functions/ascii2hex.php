<?php

function ascii2hex($ascii,$af=" ",$bef="\\x") 
{
  $hex = '';
  for ($i = 0; $i < strlen($ascii); $i++)
  {
    $byte = strtoupper(dechex(ord($ascii{$i})));
    $byte = str_repeat('0', 2 - strlen($byte)).$byte;
    $hex.=$bef.$byte.$af;
  }
  return $hex;
}

?>