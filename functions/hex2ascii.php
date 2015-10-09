<?php

function hex2ascii($hex,$af=" ")
{
  $ascii='';
  $hex=str_replace($af, null, $hex);
  for($i=0; $i<strlen($hex); $i=$i+2)
  
  {
    $ascii.=chr(hexdec(substr($hex, $i, 2)));
  }
  return($ascii);
}

?>