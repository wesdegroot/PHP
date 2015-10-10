<?php

ini_set('memory_limit', '8G');

$ex = file_get_contents("postcode_NL.csv");

$newArray=array();

$ex = explode("\n", $ex);

@mkdir('postal');

for ( $i=0; $i<sizeof($ex); $i++ )
{
	show_status($i, sizeof($ex));

	if (!empty($ex[$i]))
	{
		$ex[$i] 	= preg_replace("/\"/", null, $ex[$i]);
 		$ex2    	= explode(";", $ex[$i]);

		$newArray   = array(
						"postalcode" 	=> $ex2[1],
						"postal"      	=> $ex2[3],
						"code"			=> $ex2[4],
						"from"          => $ex2[5],
						"to"			=> $ex2[6],
						"address" 		=> $ex2[8],
						"city"          => $ex2[9],
						"province"      => $ex2[13],
						"province_short"=> $ex2[14],
						"lat"			=> $ex2[15],
						"lon"			=> $ex2[16],
						"gMaps"   		=> "https://www.google.nl/maps/place/" . $ex2[15] . "," . $ex2[16],
						"added"   		=> @date("d-m-Y H:i:s"),
						"rPid"    		=> uniqid(),
						"mPid"    		=> sha1(uniqid()),
						"sPid"    		=> md5(uniqid())
					   );

		@file_put_contents("postal/".$ex2[1].".php", "<?php\r\n\r\n\$PostalCodesNL = " . var_export($newArray, true) . ";\r\n\r\n?>");
	}
}

//file_put_contents("PostalCodesNL.php", "<?php\r\n\r\n\$PostalCodesNL = " . var_export($newArray, true) . ";\r\n\r\n?".">");

/**
 * show a status bar in the console
 * 
 * <code>
 * for($x=1;$x<=100;$x++){
 * 
 *     show_status($x, 100);
 * 
 *     usleep(100000);
 *                           
 * }
 * </code>
 *
 * @param   int     $done   how many items are completed
 * @param   int     $total  how many items are to be done total
 * @param   int     $size   optional size of the status bar
 * @return  void
 *
 */
 
function show_status($done, $total, $size=30) {
 
    static $start_time;
 
    // if we go over our bound, just ignore it
    if($done > $total) return;
 
    if(empty($start_time)) $start_time=time();
    $now = time();
 
    $perc=(double)($done/$total);
 
    $bar=floor($perc*$size);
 
    $status_bar="\r[";
    $status_bar.=str_repeat("=", $bar);
    if($bar<$size){
        $status_bar.=">";
        $status_bar.=str_repeat(" ", $size-$bar);
    } else {
        $status_bar.="=";
    }
 
    $disp=number_format($perc*100, 0);
 
    $status_bar.="] $disp%  $done/$total";
 
    $rate = ($now-$start_time)/$done;
    $left = $total - $done;
    $eta = round($rate * $left, 2);
 
    $elapsed = $now - $start_time;
 
    $status_bar.= " remaining: ".number_format($eta)." sec.  elapsed: ".number_format($elapsed)." sec.";
 
    echo "$status_bar  ";
 
    flush();
 
    // when done, send a newline
    if($done == $total) {
        echo "\n";
    }
 
}

?>