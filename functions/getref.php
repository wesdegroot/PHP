<?php

function getref()
{
 if(isset($_SERVER['HTTP_REFERER']))
 {
  return $_SERVER['HTTP_REFERER'];
 }
 else
 {
  return false;
 }
}

?>