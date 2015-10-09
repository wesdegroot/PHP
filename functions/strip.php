<?php

function strip($stringvar){
    if (get_magic_quotes_gpc()){
        $stringvar = stripslashes($stringvar);
    }
    return $stringvar;
} 

?>