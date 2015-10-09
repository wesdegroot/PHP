<?php

function realSize($size, $round = 0)
{ 
    $sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'); 
    for ($i=0; $size > 1024 && $i < count($sizes) - 1; $i++) $size /= 1024; 
    return round($size,$round).$sizes[$i]; 
} 

?>