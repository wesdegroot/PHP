<?php

function remove($file) 
{
  @chmod( $file, 0777 );
  if (is_dir($file))
  {
    return removeDirectory($file);
  }
  else
  {
    if (@unlink($file))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}

?>