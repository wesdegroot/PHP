<?php

function gethost($tf=true)
{
     $string  = getip($tf);
     $string2 = explode(".", $string);

     if(isset($string2[sizeof($string2)-2]))
     {
       if ( $string2[sizeof($string2)-2] == "co")
       {
        if ( isset ( $string2[sizeof($string2)-3] ) )
        {
          $rer = $string2[sizeof($string2)-3];
        }
        else
        {
          $rer = "Uknown";
        }
       }
       else
       {
        $rer = $string2[sizeof($string2)-2];
       }
     }
     else
     {
      $rer = "Uknown";
     }
     return $rer;
}

?>