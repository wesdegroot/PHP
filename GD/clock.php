<?php

function clock($txt = 'MyClock',$renew = '5') 
{
$size    = 125; 
$size2   = floor($size/2); 
$img     = imageCreate($size,$size); 
$image   = $img;
$wit     = imageColorAllocate($image, 255,255,255 );
$zwart   = imageColorAllocate($image, 0,0,0       );
$blauw   = imageColorAllocate($image, 0, 0, 255   );
$rood    = imageColorAllocate($image, 255, 0, 0   );
$groen   = imageColorAllocate($image, 0, 255, 0   );
$grijs   = imageColorAllocate($image, 200, 200,200);
for($min=0;$min<=60;$min++)
{ 
  if ($min % 15 == 0) 
    $len = $size2 / 5; 
  elseif ($min % 5 == 0) 
    $len = $size2 / 10; 
  else 
    $len = $size2 / 25; 
  $ang = (2 * M_PI * $min) / 60; 
  $x1 = sin($ang) * ($size2 - $len) + $size2; 
  $y1 = cos($ang) * ($size2 - $len) + $size2; 
  $x2 = (1 + sin($ang)) * $size2; 
  $y2 = (1 + cos($ang)) * $size2; 
  ImageLine($img, $x1, $y1, $x2, $y2, $zwart); 
} 
list($hour, $min, $sec) = preg_split ("/-/", Date("h-i-s", Time())); 
$hour = $hour % 12; 
$xm   = intval(cos($min * M_PI/30 - M_PI/2) * 0.65 * $size2 + $size2); 
$ym   = intval(sin($min * M_PI/30 - M_PI/2) * 0.65 * $size2 + $size2); 
$xh   = intval(cos($hour*5 * M_PI/30 - M_PI/2) * 0.5 * $size2 + $size2); 
$yh   = intval(sin($hour*5 * M_PI/30 - M_PI/2) * 0.5 * $size2 + $size2); 
$xm1  = intval(cos($sec * M_PI/30 - M_PI/2) * 0.65 * $size2 + $size2); 
$ym1  = intval(sin($sec * M_PI/30 - M_PI/2) * 0.65 * $size2 + $size2); 
ImageString($img, 2, 20, 80, $txt, $blauw);
ImageLine($img, $size2, $size2-1, $xm, $ym, $blauw); 
ImageLine($img, $size2-1, $size2, $xm, $ym, $blauw); 
ImageLine($img, $size2, $size2-1, $xh, $yh, $rood); 
ImageLine($img, $size2-1, $size2, $xh, $yh, $rood); 
ImageLine($img, $size2, $size2-1, $xm1, $ym1, $rood); 
ImageLine($img, $size2-1, $size2, $xm1, $ym1, $rood); 
header("Content-Type: image/png"); 
header("refresh: " . $renew);
imagePng($img); 
imageDestroy($img); 
exit;
}

?>