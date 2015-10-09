<?php

function getfullhost($raa = false) {
  if ( isip ( getip( $raa ) ) ) 
  {
    return gethostbyaddr ( getip ( $raa ) );   
  }
  else
  {
    return "faked. ip.";
  }
}

?>