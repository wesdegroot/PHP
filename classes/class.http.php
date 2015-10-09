<?php

class http
{
  function toggledebug($tooiw=false)
  {
    if ( isset ( $this->setdebug ) && $this->setdebug == true )
    {
      $this->setdebug = false;
    }
    else
    {
      $this->setdebug = true;
    }
  }
 
  function connect ( $to, $pa, $po=80, $uag="WesDeGroot Site System", $timeout="3" ) {
    $this -> host=$to;
    $this -> page=$pa;
    $this -> port=$po;
    $this -> cookies = null;
    $this->koekjes = array('fakecookie1=wes','wesdegroot=httpsystem');
    if ( strtoupper($this -> port) == strtoupper("HTTP") )
    {
     $this -> port = 80;   $po = 80;
    }
    if ( strtoupper($this -> port) == strtoupper("HTTPS") )
    {
     $this -> port = 443; $po = 443;
    }
    $this->socket = @fsockopen($this->host, $this->port, $this->errorno, $this->error, $timeout);
    if ( !isset ( $this->setdebug ) ) {
     $this -> setdebug=true;
     $this -> toggledebug();
    }
    $this -> useragent=$uag;
  }
  
  function setcookie($koekjes) {   
   if ( is_array ( $koekjes ) ) {
    foreach ( $koekjes As $koek => $inh ) 
    {
    $this -> cookies .= $koek . '=' . urlencode($inh) . '; '; 
    }
   }
   else
   {
    $this -> cookies = $koekjes; // zo is het voor een alt. dump vorige sessie
   }
  }
  
  function method($method)
  {
    $this -> method = strtoupper($method); 
  }
   
  function debug($TT) 
  {
    if ( $this -> setdebug == true )
    {
      echo $TT . "<hr />";
    }
  }
   
  function exec($dat=array("1"=>"2","3"=>"4"))
  {
   if ( $this->socket )
    {
      if (isset($this->host) && isset($this->page) && isset($this->port)) 
      {
        if (isset($this->method)) 
        {
          foreach($dat as $key => $value)
          {
            $dat[$key] = $key . '=' . urlencode($value);
          }
          $data = implode("&",$dat);
          $aant = strlen($data);  
          if (substr($data, 0, 1) == "&")
          {
            $data = substr($data, 1, $aant);
          }
          if ($this->method == "GET")
          {
            $this->page .= '?'.$data;
          }   
          $requestHeader = $this -> method . " " . $this -> page . "  HTTP/1.1\r\n";
          $requestHeader.= "Host: " . $this -> host . "\r\n";
          $requestHeader.= "User-Agent: " . $this -> useragent . "\r\n";
          $requestHeader.= "Cookie: " . $this -> cookies . "\r\n";
          $requestHeader.= "Content-Type: application/x-www-form-urlencoded\r\n";
          if ($this->method == "POST")
          {
            $requestHeader.= "Content-Length: ".strlen($data)."\r\n";
          }
          $requestHeader.= "Connection: close\r\n\r\n";
          if ($this->method == "POST")
          {
            $requestHeader.= $data;
          }          
          $this->debug ( $requestHeader );       
          fwrite($this -> socket, $requestHeader);       
          $responseHeader = '';
          $responseContent = '';
          do
          {
            $responseHeader.= fread($this -> socket, 1);
          }

          while (!preg_match('/\\r\\n\\r\\n$/', $responseHeader));
            if (!strstr($responseHeader, "Transfer-Encoding: chunked"))
            {
              while (!feof($this -> socket))
              {
                $responseContent.= fgets($this->socket, 128);
              }
            }
            else
            {
              while ($chunk_length = hexdec(fgets($this -> socket)))
              {
                $responseContentChunk = '';
                $read_length = 0;
                while ($read_length < $chunk_length)
                {
                  $responseContentChunk .= fread($this -> socket, $chunk_length - $read_length);
                  $read_length = strlen($responseContentChunk);
                }
                $responseContent.= $responseContentChunk;
                fgets($this -> socket);
              }
            }
          $this->debug ( $responseHeader ) ;
          $this->koekjes=array();
          if ( preg_match_all ( "/Set-Cookie: (.*); (.*)/", $responseHeader , $xxx ) ) 
          {
           for ( $i=0; $i<sizeof($xxx[1]); $i++ )
           {
            $this -> koekjes[] = $xxx[1][$i];
           }
          }
          
          if ( preg_match ( "#HTTP/1\.(.*) 404 Not Found#", $responseHeader ) ) {
          return 'ERROR';
          }
          else
          {
          return chop($responseContent);
          }
        }
        else
        {
         return "Please Set Method Use: \$something->method(\"POST\"); OR \$something->method(\"GET\");";
        }
      }
      else
      {
        return "Please Use Connect. \$something->connect(\$to, \$path, \$port);";
      }
    }
    else
    {
      $this->debug("connect error no: " . $this->errorno . "; error: " . $this->error);
      return "ERROR";
    }
  }
  
    function dumpcookies()
    {
     return implode("; ",$this -> koekjes);
    }

}

?>