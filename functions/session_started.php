<?php

function session_started()
{
 if ( isset ( $_SESSION ) )
 {
  return true;
 }
 else
 {
  return false;
 }
}

?>