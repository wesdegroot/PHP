<?php

function loop($from, $to, $steps=1)
{
	for($i = $from; $i <= $to; $i += $steps)
 	{
    	$temp[] = $i;
   	}
  
  	return $temp;
}

?>