<?php

function _hex_rand_($einde,$bef=false)
{
 if ($bef == false)
     $bef = '0';
 $add=$bef . "x";
 $tel = 0;
  while($tel <= $einde) {
   $add .= rand(0,9);
   $tel++;
  }
  return $add;
}

?>