<?php

function soficheck($sNr) 
{ 
    if (eregi('[1-9]{1}[0-9]{8}',$sNr) && strlen($sNr) == 9) 
        { 
        $sofiCheck = 0; 
        
        for ($i=0;$i<9;$i++) 
           { 
           $x = 9 - $i; 
           if($x>1) 
              { 
              $sofiCheck += ($sNr{$i} * $x); 
              } 
           else 
              { 
              $sofiCheck -= ($sNr{$i} * $x); 
              } 
           } 
        if($sofiCheck % 11==0) 
            { 
            return true; 
            } 
        } 
        return false; 
}

?>