<?php

function combo($str, $temp="") 
{
    if ($str == "") 
    {
     echo $temp . "\n";
    }
    else
    {
            $strcount = strlen($str);
            for($i = 0; $i < $strcount; $i++) 
            {
              $start = $temp . substr($str, $i, 1);
              $rest = substr($str, 0, $i) . substr($str, $i + 1);
              combo($rest, $start);
            }
    }
}

?>