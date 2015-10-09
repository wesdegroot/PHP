<?php

function xmail($to,$subject,$text,$frorm,$m='normal',$send=array(null,null), $reply=array('def','def'))
{
if ( !is_array ( $frorm ) || !is_array ( $text ) || !is_array ( $reply ) || !is_array ( $send ) )
{
 return array(false,'need $me And $text And $reply as array<br/>' . 
 'Ex:  xmail($to,$subject,$text=array(\'plain\',\'html\'),$me=array(\'name\',\'em@il\'),$prio=\'normal\',[$sendfrom=array(\'name\',\'email\')],[$reply]); //[] is optional and array as $me ((if u want to skipe something please put there null, ex $reply=array(null,null) and done))<br/>' .
 null);
}
else
{
if ( is_array( $to ) )
{
 $ret=array();
 for ( $i=0; $i<sizeof($to); $i++ )
 {
  if(isset($to[$i]))
  {
   $ret[] = xmail($to[$i],$subject,$text,$frorm,$m,$reply);
  }
 }
 return array(null,$ret);
}
else
{
  $x=null;
	$prio=3;
	if($m=='normal') $prio=3;
	if($m=='high')   $prio=1;
	if($m=='low')    $prio=5;
	if($m==1||$m==3||$m==5)
	 $prio=$m;

    if($reply[0]=='def')
     $reply[0]=$frorm[0];
    if($reply[1]=='def')
     $reply[1]=$frorm[1];

   if(!isset($send)) $send=array(null,null);
    if( ($send[0]!=null) && ($send[1]!=null) )
     $x = "Sender: {$send[0]} <{$send[1]}>\n";     
          
$notice_text = "This is a multi-part message in MIME format.";
$semi_rand = md5(time());
$mime_boundary = "==MULTIPART_BOUNDARY_$semi_rand";
$mime_boundary_header = chr(34) . $mime_boundary . chr(34);
$from = "{$frorm[0]} <{$frorm[1]}>";
$body = "$notice_text

--$mime_boundary
Content-Type: text/plain; charset=us-ascii
Content-Transfer-Encoding: 7bit

{$text[0]}

--$mime_boundary
Content-Type: text/html; charset=us-ascii
Content-Transfer-Encoding: 7bit

{$text[1]}

--$mime_boundary--";

if (@$W=@mail($to, $subject, $body,
    "From: " . $from . "\n" .
    "Return-Path: {$reply[0]} <{$reply[1]}>\n" .
    'X-Priority: ' . $prio . "\n" .
	  'X-MSMail-Priority: ' . ucfirst($m) . "\n" .
	  $x .
	  "X-Mailer: Php Mailer\n" .
    "MIME-Version: 1.0\n" .
    "Content-Type: multipart/alternative;\n" .
    "     boundary=" . $mime_boundary_header))
    return array(true,'mail sended To "'.$to.'" :D ('.$W.')');
else
    return array(false,'mail not send To "'.$to.'" ('.$W.')');
}
}
}

?>