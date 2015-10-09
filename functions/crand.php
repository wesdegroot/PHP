<?php

function crand($length, $type = "a-A-1") 
{
    $code_char = '';
    $type = explode("-", $type);
    
    foreach($type as $var) 
    {
        if($var=='a') 
        {
            $code_char .= 'abcdefghijklmnopqrstuvwxyz';
        }
        if($var=='A') 
        {
            $code_char .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if($var=='1') 
        {
            $code_char .= '0123456789';
        }
    }
    
    $num_char = strlen($code_char);
    
    while($length>$i) 
    {
        $i++;
        $num = rand(0, $num_char);
        $code .= substr($code_char, $num, 1);
    }
    
    //return random string
    return $code;
} 

?>