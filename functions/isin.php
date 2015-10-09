<?php

function isin($what,$inco,$hl=false)
{
 //hoofdletter gevoelig ($hl==true) ((strstr))
 //niet hlettr gevoelig ($hl=false) ((stristr))
 $wrgx1 = $inco;
 $wrgx2 = $what;
    if ($hl == false)
    {
      if (stristr($wrgx1, $wrgx2))
      {
       return true;
      }
      else
      {
       return false;
      }
    }
    else
    {
      if (strstr($wrgx1, $wrgx2))
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