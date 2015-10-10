<?php

define('EOL' , isset($_SERVER['PWD']) ? PHP_EOL : '<br />');

$my = postal("2037HA");

echo sprintf("Adress: %s%sCity: %s%sProvince: %s%sFrom: %s%sTo: %s%sLat: %s%sLon: %s%s",
	         $my['address'], EOL, 
	         $my['city'], 	 EOL,
	         $my['province'],EOL,
	         $my['from'],    EOL,
	         $my['to'],      EOL,
	         $my['lat'],     EOL,
	         $my['lon'],     EOL);

function postal($code)
{
	if ( file_exists ( "postal/" . $code . ".php") )
	{
		include "postal/" . $code . ".php";

		return $PostalCodesNL;
	}
	else
	{
		return false;
	}
}

?>