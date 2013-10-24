<?php
# { PHP Parameters
	set_time_limit(0);
# }

# { CONFIG
	$maxdeepth = 50;
	$site = 'http://www.wdgwv.nl/'; //With /trailing slash.
	$clean = 'www\.wdgwv\.nl'; //mark . with \. for regex!!!
	$external = false; //external links allowed?...
# }

/*
                   :....................,:,              
                ,.`,,,::;;;;;;;;;;;;;;;;:;`              
              `...`,::;:::::;;;;;;;;;;;;;::'             
             ,..``,,,::::::::::::::::;:;;:::;            
            :.,,``..::;;,,,,,,,,,,,,,:;;;;;::;`          
           ,.,,,`...,:.:,,,,,,,,,,,,,:;:;;;;:;;          
          `..,,``...;;,;::::::::::::::'';';';:''         
          ,,,,,``..:;,;;:::::::::::::;';;';';;'';        
         ,,,,,``....;,,:::::::;;;;;;;;':'''';''+;        
         :,::```....,,,:;;;;;;;;;;;;;;;''''';';';;       
        `,,::``.....,,,;;;;;;;;;;;;;;;;'''''';';;;'      
        :;:::``......,;;;;;;;;:::::;;;;'''''';;;;:       
        ;;;::,`.....,::;;::::::;;;;;;;;'''''';;,;;,      
        ;:;;:;`....,:::::::::::::::::;;;;'''':;,;;;      
        ';;;;;.,,,,::::::::::::::::::;;;;;''':::;;'      
        ;';;;;.;,,,,::::::::::::::::;;;;;;;''::;;;'      
        ;'';;:;..,,,;;;:;;:::;;;;;;;;;;;;;;;':::;;'      
        ;'';;;;;.,,;:;;;;;;;;;;;;;;;;;;;;;;;;;:;':;      
        ;''';;:;;.;;;;;;;;;;;;;;;;;;;;;;;;;;;''';:.      
        :';';;;;;;::,,,,,,,,,,,,,,:;;;;;;;;;;'''';       
         '';;;;:;;;.,,,,,,,,,,,,,,,,:;;;;;;;;'''''       
         '''';;;;;:..,,,,,,,,,,,,,,,,,;;;;;;;''':,       
         .'''';;;;....,,,,,,,,,,,,,,,,,,,:;;;''''        
          ''''';;;;....,,,,,,,,,,,,,,,,,,;;;''';.        
           '''';;;::.......,,,,,,,,,,,,,:;;;''''         
           `''';;;;:,......,,,,,,,,,,,,,;;;;;''          
            .'';;;;;:.....,,,,,,,,,,,,,,:;;;;'           
             `;;;;;:,....,,,,,,,,,,,,,,,:;;''            
               ;';;,,..,.,,,,,,,,,,,,,,,;;',             
                 '';:,,,,,,,,,,,,,,,::;;;:               
                  `:;'''''''''''''''';:.                 
                                                         
 ,,,::::::::::::::::::::::::;;;;,::::::::::::::::::::::::
 ,::::::::::::::::::::::::::;;;;,::::::::::::::::::::::::
 ,:; ## ## ##  #####     ####      ## ## ##  ##   ##  ;::
 ,,; ## ## ##  ## ##    ##         ## ## ##  ##   ##  ;::
 ,,; ## ## ##  ##  ##  ##   ####   ## ## ##   ## ##   ;::
 ,,' ## ## ##  ## ##    ##    ##   ## ## ##   ## ##   :::
 ,:: ########  ####      ######    ########    ###    :::
 ,,,:,,:,,:::,,,:;:::::::::::::::;;;:::;:;:::::::::::::::
 ,,,,,,,,,,,,,,,,,,,,,,,,:,::::::;;;;:::::;;;;::::;;;;:::
                                                         
	     (c) WDGWV. 2013, http://www.wdgwv.nl            
	 websites, Apps, Hosting, Services, Development.      

  File Checked.
  Checked by: WdG.
  date: 07-06-2013

  © WDGWV, www.wdgwv.nl
  All Rights Reserved.

  FREE FOR NON-COMMERCIAL USE
*/



# { NEEDED FOR USE
	$links = array();
	$deepth = 0;
# }

# { Regex
    $regex  = '/(<a\s*'; // Start of anchor tag
    $regex .= '(.*?)\s*'; // Any attributes or spaces that may or may not exist
    $regex .= 'href=[\'"]+?\s*(?P<link>\S+)\s*[\'"]+?'; // Grab the link
    $regex .= '\s*(.*?)\s*>\s*'; // Any attributes or spaces that may or may not exist before closing tag 
    $regex .= '(?P<name>\S+)'; // Grab the name
    $regex .= '\s*<\/a>)/i'; // Any number of spaces between the closing anchor tag (case insensitive)
# }

# { FUNCTIONS
	function grab_urls($link)
	{
		global $site, $deepth, $maxdeepth, $regex, $links, $clean; #ask the globals.

		echo "*** PARSING ".$link." ".$deepth."/".$maxdeepth.".\r\n";

		$test = file_get_contents($link); //get the site...
		$ret = preg_match_all($regex, $test, $return); // parse for urls
		
		$deepth++; //count +1

		foreach($return['link'] as $url) //return link as url.
		{
			if(substr($url, 0, 1) == '/')  //fix sites with only /
				$url = $site . substr($url, 1); // add. + http.

			if ($deepth < $maxdeepth && !in_array($url, $links)) //not to deep?
			{
				$links[] = $url; // add...

				if(preg_match("#".$clean."#", $url)) //is local so parse...
				{
					echo "*** queue added $url.\r\n";
					grab_urls($url); //parse
				}
				else
				{
					if ($external)
					{
						echo "*** external queue added $url.\r\n";
						grab_urls($url);
					}
					else
					{
						echo "*** IGNORED -> EXTERNAL LINK $url\r\n";
					}
				}
			}
		}
	}

echo base64_decode("ICAgICAgICAgICAgICAgICAgIDouLi4uLi4uLi4uLi4uLi4uLi4uLiw6LCAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAsLmAsLCw6Ojs7Ozs7Ozs7Ozs7Ozs7Ozs6O2AgICAgICAgICAgICAgIAogICAgICAgICAgICAgIGAuLi5gLDo6Ozo6Ojo6Ozs7Ozs7Ozs7Ozs7Ozo6JyAgICAgICAgICAgICAKICAgICAgICAgICAgICwuLmBgLCwsOjo6Ojo6Ojo6Ojo6Ojo6Ojs6Ozs6Ojo7ICAgICAgICAgICAgCiAgICAgICAgICAgIDouLCxgYC4uOjo7OywsLCwsLCwsLCwsLCw6Ozs7Ozs6OjtgICAgICAgICAgIAogICAgICAgICAgICwuLCwsYC4uLiw6LjosLCwsLCwsLCwsLCwsOjs6Ozs7Ozo7OyAgICAgICAgICAKICAgICAgICAgIGAuLiwsYGAuLi47Oyw7Ojo6Ojo6Ojo6Ojo6OjonJzsnOyc7OicnICAgICAgICAgCiAgICAgICAgICAsLCwsLGBgLi46Oyw7Ozo6Ojo6Ojo6Ojo6Ojo7Jzs7JzsnOzsnJzsgICAgICAgIAogICAgICAgICAsLCwsLGBgLi4uLjssLDo6Ojo6Ojo7Ozs7Ozs7Oyc6JycnJzsnJys7ICAgICAgICAKICAgICAgICAgOiw6OmBgYC4uLi4sLCw6Ozs7Ozs7Ozs7Ozs7Ozs7JycnJyc7JzsnOzsgICAgICAgCiAgICAgICAgYCwsOjpgYC4uLi4uLCwsOzs7Ozs7Ozs7Ozs7Ozs7OycnJycnJzsnOzs7JyAgICAgIAogICAgICAgIDo7Ojo6YGAuLi4uLi4sOzs7Ozs7Ozs6Ojo6Ojs7OzsnJycnJyc7Ozs7OiAgICAgICAKICAgICAgICA7Ozs6OixgLi4uLi4sOjo7Ozo6Ojo6Ojs7Ozs7Ozs7JycnJycnOzssOzssICAgICAgCiAgICAgICAgOzo7Ozo7YC4uLi4sOjo6Ojo6Ojo6Ojo6Ojo6Ojo7Ozs7JycnJzo7LDs7OyAgICAgIAogICAgICAgICc7Ozs7Oy4sLCwsOjo6Ojo6Ojo6Ojo6Ojo6Ojo6Ozs7OzsnJyc6Ojo7OycgICAgICAKICAgICAgICA7Jzs7OzsuOywsLCw6Ojo6Ojo6Ojo6Ojo6Ojo6Ozs7Ozs7OycnOjo7OzsnICAgICAgCiAgICAgICAgOycnOzs6Oy4uLCwsOzs7Ojs7Ojo6Ozs7Ozs7Ozs7Ozs7Ozs7Jzo6Ojs7JyAgICAgIAogICAgICAgIDsnJzs7Ozs7LiwsOzo7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OjsnOjsgICAgICAKICAgICAgICA7JycnOzs6OzsuOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7JycnOzouICAgICAgCiAgICAgICAgOic7Jzs7Ozs7Ozo6LCwsLCwsLCwsLCwsLCw6Ozs7Ozs7Ozs7OycnJyc7ICAgICAgIAogICAgICAgICAnJzs7Ozs6Ozs7LiwsLCwsLCwsLCwsLCwsLCw6Ozs7Ozs7OzsnJycnJyAgICAgICAKICAgICAgICAgJycnJzs7Ozs7Oi4uLCwsLCwsLCwsLCwsLCwsLCw7Ozs7Ozs7JycnOiwgICAgICAgCiAgICAgICAgIC4nJycnOzs7Oy4uLi4sLCwsLCwsLCwsLCwsLCwsLCwsOjs7OycnJycgICAgICAgIAogICAgICAgICAgJycnJyc7Ozs7Li4uLiwsLCwsLCwsLCwsLCwsLCwsLDs7OycnJzsuICAgICAgICAKICAgICAgICAgICAnJycnOzs7OjouLi4uLi4uLCwsLCwsLCwsLCwsLDo7OzsnJycnICAgICAgICAgCiAgICAgICAgICAgYCcnJzs7Ozs6LC4uLi4uLiwsLCwsLCwsLCwsLCw7Ozs7OycnICAgICAgICAgIAogICAgICAgICAgICAuJyc7Ozs7OzouLi4uLiwsLCwsLCwsLCwsLCwsOjs7OzsnICAgICAgICAgICAKICAgICAgICAgICAgIGA7Ozs7OzosLi4uLiwsLCwsLCwsLCwsLCwsLDo7OycnICAgICAgICAgICAgCiAgICAgICAgICAgICAgIDsnOzssLC4uLC4sLCwsLCwsLCwsLCwsLCw7OycsICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICcnOzosLCwsLCwsLCwsLCwsLCw6Ojs7OzogICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgYDo7JycnJycnJycnJycnJycnJzs6LiAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogLCwsOjo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ozs7Oyw6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6OjoKICw6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojs7OzssOjo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6CiAsOjsgIyMgIyMgIyMgICMjIyMjICAgICAjIyMjICAgICAgIyMgIyMgIyMgICMjICAgIyMgIDs6OgogLCw7ICMjICMjICMjICAjIyAjIyAgICAjIyAgICAgICAgICMjICMjICMjICAjIyAgICMjICA7OjoKICwsOyAjIyAjIyAjIyAgIyMgICMjICAjIyAgICMjIyMgICAjIyAjIyAjIyAgICMjICMjICAgOzo6CiAsLCcgIyMgIyMgIyMgICMjICMjICAgICMjICAgICMjICAgIyMgIyMgIyMgICAjIyAjIyAgIDo6OgogLDo6ICMjIyMjIyMjICAjIyMjICAgICAgIyMjIyMjICAgICMjIyMjIyMjICAgICMjIyAgICA6OjoKICwsLDosLDosLDo6OiwsLDo7Ojo6Ojo6Ojo6Ojo6Ojo6Ozs7Ojo6Ozo7Ojo6Ojo6Ojo6Ojo6Ojo6CiAsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCw6LDo6Ojo6Ojs7Ozs6Ojo6Ojs7Ozs6Ojo6Ozs7Ozo6OgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKCSAgICAgKGMpIFdER1dWLiAyMDEzLCBodHRwOi8vd3d3LndkZ3d2Lm5sICAgICAgICAgICAgCgkgd2Vic2l0ZXMsIEFwcHMsIEhvc3RpbmcsIFNlcnZpY2VzLCBEZXZlbG9wbWVudC4gICAgICAK"); //WDGWV LOGO
echo "\r\nWDGWV Link checker.\r\n";
echo "Version 1.0 -- http://www.wdgwv.nl\r\n";

grab_urls($site); //grab the urls.

for($i=0; $i<sizeof($links); $i++)
{
	echo ("* ".$links[$i]."\r\n");
	//add site by site.
}

//print_r($links);
//print the websites.

?>