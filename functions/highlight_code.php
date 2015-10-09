<?php

function highlight_code($ooo) 
{
  ob_start();
  $ret = highlight_string("<?php ".$ooo." ?>");
  $ret = ob_get_contents();
  ob_end_clean();

  return $ret;
}

?>