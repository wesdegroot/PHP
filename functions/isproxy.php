<?php

function isproxy() {
  return (getip(true) != getip(false)) ? true : false;
}

?>