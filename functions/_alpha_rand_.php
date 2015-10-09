<?php

function _alpha_rand_($einde,$bef=false)
{
  $alpha = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
  $tel = 0;
  $add = $bef;
    while($tel <= $einde) {
     $add .= $alpha[rand(1,sizeof($alpha))-1];
     $tel++;
    }
  return $add;
}

?>