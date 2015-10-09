<?php

function ext($name = "error.error",$tf = false) 
{
$expl = explode(".",$name); 
$size = ( sizeof ( $expl ) > 1 ) ? sizeof($expl) : 2 ;

 if($tf == true) 
 {
  $ttt = 0;
  $add = false;
   while($ttt < $size-1) 
   {
    $add .= $expl[$ttt];
    if($ttt < $size-2) 
    {
    $add .= '.';
    }
    $ttt++;
   }
  return substr($add, 0, strlen($add)-ext($name)+1);
 }
 else
 {
  return isset($expl[$size-1]) ? $expl[$size-1] : 'error';
 }
}

?>