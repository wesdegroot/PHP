<?php

function removeDirectory($path) 
{
 if (is_dir($path)) 
 {
   if ($handle = opendir($path)) 
   {
     while (false !== ($file = readdir($handle))) 
     {
       if ($file != '.' && $file != '..') 
       {
         if (is_dir($path."/".$file))
          removeDirectory($path."/".$file);
         @unlink($path."/".$file);
        }
       }
     @closedir($handle);
     @rmdir($path);
     return 1;
   }
 }
 return;
}

?>