<?php

function _num_rand_($einde,$bef=false)
{
  $tel = 0;
  $add = $bef;
    while($tel <= $einde) {
     $add .= rand(0,9);
     $tel++;
    }
  return $add;
}

?>