<?php

function go($url) 
{
 if(!headers_sent()) 
 {
  header("location: " . $url);
 }
  echo "<a href='" . $url . "'> Please Click Here </a><meta http-equiv=\"refresh\" content=\"0;URL='" . $url . "'\" />\n<script language=\"JavaScript\">\n<!--\nwindow.location=\"" . $url . "\";\n//-->\n</script>";
  exit;
}

?>