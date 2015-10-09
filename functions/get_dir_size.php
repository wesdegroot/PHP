<?php

function get_dir_size($path)
{
  if(!is_dir($path)) return filesize($path);
  if ($handle = opendir($path)) 
  {
    $size = 0;
    while (false !== ($file = readdir($handle))) 
    {
      if($file!='.' && $file!='..') 
      {
        $size += realSize($path.'/'.$file);
      }
    }
    closedir($handle);
    return $size;
  }
}

?>