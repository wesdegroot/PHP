<?php

function httpstatus($num,$return=false) {
    if ( isset ( $_SERVER['SERVER_PROTOCOL'] ) )
    {
      $protocol = $_SERVER['SERVER_PROTOCOL'];
    }
    else
    {
      $protocol = 'HTTP/1.1';
    }

   $http = array (
       '100' => $protocol . " 100 Continue",
       '101' => $protocol . " 101 Switching Protocols",
       '200' => $protocol . " 200 OK",
       '201' => $protocol . " 201 Created",
       '202' => $protocol . " 202 Accepted",
       '203' => $protocol . " 203 Non-Authoritative Information",
       '204' => $protocol . " 204 No Content",
       '205' => $protocol . " 205 Reset Content",
       '206' => $protocol . " 206 Partial Content",
       '300' => $protocol . " 300 Multiple Choices",
       '301' => $protocol . " 301 Moved Permanently",
       '302' => $protocol . " 302 Found",
       '303' => $protocol . " 303 See Other",
       '304' => $protocol . " 304 Not Modified",
       '305' => $protocol . " 305 Use Proxy",
       '307' => $protocol . " 307 Temporary Redirect",
       '400' => $protocol . " 400 Bad Request",
       '401' => $protocol . " 401 Unauthorized",
       '402' => $protocol . " 402 Payment Required",
       '403' => $protocol . " 403 Forbidden",
       '404' => $protocol . " 404 Not Found",
       '405' => $protocol . " 405 Method Not Allowed",
       '406' => $protocol . " 406 Not Acceptable",
       '407' => $protocol . " 407 Proxy Authentication Required",
       '408' => $protocol . " 408 Request Time-out",
       '409' => $protocol . " 409 Conflict",
       '410' => $protocol . " 410 Gone",
       '411' => $protocol . " 411 Length Required",
       '412' => $protocol . " 412 Precondition Failed",
       '413' => $protocol . " 413 Request Entity Too Large",
       '414' => $protocol . " 414 Request-URI Too Large",
       '415' => $protocol . " 415 Unsupported Media Type",
       '416' => $protocol . " 416 Requested range not satisfiable",
       '417' => $protocol . " 417 Expectation Failed",
       '500' => $protocol . " 500 Internal Server Error",
       '501' => $protocol . " 501 Not Implemented",
       '502' => $protocol . " 502 Bad Gateway",
       '503' => $protocol . " 503 Service Unavailable",
       '504' => $protocol . " 504 Gateway Time-out"       
   );
   if ( isset ( $http [ $num ] ) )
   {
    if ( $return == false )
    {
      if ( !headers_sent ( $file, $line ) ) 
      {
        header( $http [ $num ] ) ;
      }
      else
      {
        trigger_error ( 'headers Are sent In ' . $file . ' @ ' . $line, E_USER_ERROR ) ;
      }
    }
    else
    {
     return $http [ $num ] ;
    }
   }
}

?>