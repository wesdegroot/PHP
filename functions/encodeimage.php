<?php

function encodeimage($img)
{
  return withBreak(base64_encode(file_get_contents($img)),116);
}

?>