<?php

function spliturl($url)
{
	preg_match("#((h|H)(t|T)(t|T)(p|P):\/\/)(.+?)\/(.*)#",$url,$p);
	if ( isset ( $p[6] ) ) {
		$p[6] = explode(':',$p[6]);
	}
	else
	{
		$p[6][0] = 'Error';
	}
	
	if(!isset($p[7]))
	{
		$p[7] = 'Error';
	}
	
	if ( isset ( $p[6][1] ) )
	{
		$port = $p[6][1];
	}
	else
	{
		$port = 80;
	}
	$p[6] = $p[6][0];
	return array(
		$p[6],
		$p[7],
		$port,
		'host' => $p[6],
		'url'  => $p[7],
		'port' => $port
	);
}

?>