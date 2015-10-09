<?php

function renew($time,$url = fullurl,$tof = false) 
{
 if(!headers_sent()) 
 {
  header("refresh: " . $time . "; url=\"" . $url ."\"");
 }
 if ($tof == false) 
 {
  $lis = "no";
 }
 else
 {
  $lis = "yes"; 
 }
 echo "<meta http-equiv=\"refresh\" content=\"" . $time . ";URL='" . $url . "'\" />" .
 "<script language=\"JavaScript\">\r\n// Verander hier de tijd dat er refreshed moe" .
 "t worden ( in seconden )\r\nvar refreshinterval=".$time."\r\n// Wil je de refresh" .
 " in je statusbalk zichtbaar ? ( yes of No )\r\nvar displaycountdown=\"" . $lis ."" .
 "\"\r\nvar starttime;\r\nvar nowtime\r\nvar reloadseconds=0\r\nvar secondssinceloa" .
 "ded=0\r\n\r\nfunction starttime() {\r\n	starttime=new Date()\r\n	starttime=start" .
 "time.getTime()\r\n  countdown()\r\n}\r\n\r\nfunction countdown() {\r\n	nowtime= " .
 "new Date()\r\n	nowtime=nowtime.getTime()\r\n	secondssinceloaded=(nowtime-startti" .
 "me)/1000\r\n	reloadseconds=Math.round(refreshinterval-secondssinceloaded)\r\n	i" .
 "f (refreshinterval>=secondssinceloaded) {\r\n        var timer=setTimeout(\"count" .
 "down()\",1000)\r\n		if (displaycountdown==\"yes\") {\r\n			window.status=\"P" .
 "age refreshing in \"+reloadseconds+ \" seconds\"\r\n		}\r\n    }\r\n    else { " .
 "\r\n        clearTimeout(timer)\r\n        window.location=\"" . $url . "\";\r\n " .
 "   }\r\n }\r\nwindow.onload=starttime\r\n</script>";
} 

?>