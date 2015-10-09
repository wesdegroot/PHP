<?php

function withBreak($string, $characters, $begin=0, $total='NEW') 
{  
  $aantal  = strlen($string);
  $stringo = $string;

  if ($total=='NEW')
  {
    $total = strlen($string);
  }

  if($aantal > $characters)  
  {  
    $string = substr($stringo, $begin, $characters) . "\r\n";
  }   

  if ($total>1)
  {
    $string .= withBreak($stringo, $characters, $begin+$characters, $total-$characters);
  }

  return $string;  
}

?>