<?php

function make_dir($dir) 
{
  $dir     = explode("/",$dir);
  $bev     = false;
  $siz     = sizeof($dir);
  $dir_1   = $dir['0'];
  $dir_all = $dir_1;
  $set     = false;
  
  if(!file_exists($dir_1)) 
  {
   if(@mkdir($dir_1))
    $set = true;
  }
  
  @chmod( $dir_1, 0777 );
  $count = 1;
  while ( $count < $siz ) 
  {
    $dir_all = $dir_all . "/" . $dir[$count];
    if(!file_exists($dir_all)) {
     if(@mkdir($dir_all,0777))
      $set = true;
      
      @chmod( $dir_all, 0777 );
    }
   $count = $count + 1;
  }
  
  return $set;
}

?>