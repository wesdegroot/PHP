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

  FREE FOR NON-COMMERCIAL USEl
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
$fh = @fopen('sitemap.xml', 'w');
if (!$fh)
	exit('need write permissions.');

# { FUNCTIONS
	function grab_urls($link)
	{
		_show();

		global $site, $deepth, $maxdeepth, $regex, $links, $clean; #ask the globals.

		$ddeepth     = ($deepth + 1);
		if ($ddeepth < 10)
			$ddeepth = "0".$deepth;

		echo "*** [".($ddeepth)."/".$maxdeepth."] PARSING ".$link.".\r\n";

		$test = file_get_contents($link); //get the site...
		$ret = preg_match_all($regex, $test, $return); // parse for urls
		
		$deepth++; //count +1

		foreach($return['link'] as $url) //return link as url.
		{
			if(substr($url, 0, 1) == '/')  //fix sites with only /
				$url = $site . substr($url, 1); // add. + http.

			if ($deepth < $maxdeepth && !in_array($url, $links)) //not to deep?
			{
				if(preg_match("#".$clean."#", $url)) //is local so parse...
				{
					$links[] = $url; // add...
					echo "*** queue added $url.\r\n";
					grab_urls($url); //parse
				}
				else
				{
					if ($external)
					{
						$links[] = $url; // add...
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

_show();

grab_urls($site); //grab the urls.

fwrite($fh, "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\r\n\r\n<!--\r\ncreated with WDGWV Sitemap Generator www.wdgwv.nl\r\n-->\r\n");
// add header.

for($i=0; $i<sizeof($links); $i++)
{
	$links[$i] = preg_replace("#&#", "&amp;", $links[$i]);
	//make links good for sitemap.

	fwrite($fh, "<url>\r\n<loc>".$links[$i]."</loc>\r\n<changefreq>daily</changefreq>\r\n<priority>1.00</priority>\r\n</url>\r\n");
	//add site by site.
}

fwrite($fh, "</urlset>");
// add end of file.

fclose($fh);
//close file

//print_r($links);
//print the websites.

_show();
echo "finished see sitemap.xml\r\n";
//send finished message...

function _show()
{
	echo base64_decode("ICAgICAgICAgICAgICAgICAgIDouLi4uLi4uLi4uLi4uLi4uLi4uLiw6LCAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAsLmAsLCw6Ojs7Ozs7Ozs7Ozs7Ozs7Ozs6O2AgICAgICAgICAgICAgIAogICAgICAgICAgICAgIGAuLi5gLDo6Ozo6Ojo6Ozs7Ozs7Ozs7Ozs7Ozo6JyAgICAgICAgICAgICAKICAgICAgICAgICAgICwuLmBgLCwsOjo6Ojo6Ojo6Ojo6Ojo6Ojs6Ozs6Ojo7ICAgICAgICAgICAgCiAgICAgICAgICAgIDouLCxgYC4uOjo7OywsLCwsLCwsLCwsLCw6Ozs7Ozs6OjtgICAgICAgICAgIAogICAgICAgICAgICwuLCwsYC4uLiw6LjosLCwsLCwsLCwsLCwsOjs6Ozs7Ozo7OyAgICAgICAgICAKICAgICAgICAgIGAuLiwsYGAuLi47Oyw7Ojo6Ojo6Ojo6Ojo6OjonJzsnOyc7OicnICAgICAgICAgCiAgICAgICAgICAsLCwsLGBgLi46Oyw7Ozo6Ojo6Ojo6Ojo6Ojo7Jzs7JzsnOzsnJzsgICAgICAgIAogICAgICAgICAsLCwsLGBgLi4uLjssLDo6Ojo6Ojo7Ozs7Ozs7Oyc6JycnJzsnJys7ICAgICAgICAKICAgICAgICAgOiw6OmBgYC4uLi4sLCw6Ozs7Ozs7Ozs7Ozs7Ozs7JycnJyc7JzsnOzsgICAgICAgCiAgICAgICAgYCwsOjpgYC4uLi4uLCwsOzs7Ozs7Ozs7Ozs7Ozs7OycnJycnJzsnOzs7JyAgICAgIAogICAgICAgIDo7Ojo6YGAuLi4uLi4sOzs7Ozs7Ozs6Ojo6Ojs7OzsnJycnJyc7Ozs7OiAgICAgICAKICAgICAgICA7Ozs6OixgLi4uLi4sOjo7Ozo6Ojo6Ojs7Ozs7Ozs7JycnJycnOzssOzssICAgICAgCiAgICAgICAgOzo7Ozo7YC4uLi4sOjo6Ojo6Ojo6Ojo6Ojo6Ojo7Ozs7JycnJzo7LDs7OyAgICAgIAogICAgICAgICc7Ozs7Oy4sLCwsOjo6Ojo6Ojo6Ojo6Ojo6Ojo6Ozs7OzsnJyc6Ojo7OycgICAgICAKICAgICAgICA7Jzs7OzsuOywsLCw6Ojo6Ojo6Ojo6Ojo6Ojo6Ozs7Ozs7OycnOjo7OzsnICAgICAgCiAgICAgICAgOycnOzs6Oy4uLCwsOzs7Ojs7Ojo6Ozs7Ozs7Ozs7Ozs7Ozs7Jzo6Ojs7JyAgICAgIAogICAgICAgIDsnJzs7Ozs7LiwsOzo7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OjsnOjsgICAgICAKICAgICAgICA7JycnOzs6OzsuOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7JycnOzouICAgICAgCiAgICAgICAgOic7Jzs7Ozs7Ozo6LCwsLCwsLCwsLCwsLCw6Ozs7Ozs7Ozs7OycnJyc7ICAgICAgIAogICAgICAgICAnJzs7Ozs6Ozs7LiwsLCwsLCwsLCwsLCwsLCw6Ozs7Ozs7OzsnJycnJyAgICAgICAKICAgICAgICAgJycnJzs7Ozs7Oi4uLCwsLCwsLCwsLCwsLCwsLCw7Ozs7Ozs7JycnOiwgICAgICAgCiAgICAgICAgIC4nJycnOzs7Oy4uLi4sLCwsLCwsLCwsLCwsLCwsLCwsOjs7OycnJycgICAgICAgIAogICAgICAgICAgJycnJyc7Ozs7Li4uLiwsLCwsLCwsLCwsLCwsLCwsLDs7OycnJzsuICAgICAgICAKICAgICAgICAgICAnJycnOzs7OjouLi4uLi4uLCwsLCwsLCwsLCwsLDo7OzsnJycnICAgICAgICAgCiAgICAgICAgICAgYCcnJzs7Ozs6LC4uLi4uLiwsLCwsLCwsLCwsLCw7Ozs7OycnICAgICAgICAgIAogICAgICAgICAgICAuJyc7Ozs7OzouLi4uLiwsLCwsLCwsLCwsLCwsOjs7OzsnICAgICAgICAgICAKICAgICAgICAgICAgIGA7Ozs7OzosLi4uLiwsLCwsLCwsLCwsLCwsLDo7OycnICAgICAgICAgICAgCiAgICAgICAgICAgICAgIDsnOzssLC4uLC4sLCwsLCwsLCwsLCwsLCw7OycsICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICcnOzosLCwsLCwsLCwsLCwsLCw6Ojs7OzogICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgYDo7JycnJycnJycnJycnJycnJzs6LiAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogLCwsOjo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ozs7Oyw6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6OjoKICw6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojs7OzssOjo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6Ojo6CiAsOjsgIyMgIyMgIyMgICMjIyMjICAgICAjIyMjICAgICAgIyMgIyMgIyMgICMjICAgIyMgIDs6OgogLCw7ICMjICMjICMjICAjIyAjIyAgICAjIyAgICAgICAgICMjICMjICMjICAjIyAgICMjICA7OjoKICwsOyAjIyAjIyAjIyAgIyMgICMjICAjIyAgICMjIyMgICAjIyAjIyAjIyAgICMjICMjICAgOzo6CiAsLCcgIyMgIyMgIyMgICMjICMjICAgICMjICAgICMjICAgIyMgIyMgIyMgICAjIyAjIyAgIDo6OgogLDo6ICMjIyMjIyMjICAjIyMjICAgICAgIyMjIyMjICAgICMjIyMjIyMjICAgICMjIyAgICA6OjoKICwsLDosLDosLDo6OiwsLDo7Ojo6Ojo6Ojo6Ojo6Ojo6Ozs7Ojo6Ozo7Ojo6Ojo6Ojo6Ojo6Ojo6CiAsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCw6LDo6Ojo6Ojs7Ozs6Ojo6Ojs7Ozs6Ojo6Ozs7Ozo6OgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKCSAgICAgKGMpIFdER1dWLiAyMDEzLCBodHRwOi8vd3d3LndkZ3d2Lm5sICAgICAgICAgICAgCgkgd2Vic2l0ZXMsIEFwcHMsIEhvc3RpbmcsIFNlcnZpY2VzLCBEZXZlbG9wbWVudC4gICAgICAK"); //WDGWV LOGO
	echo "\r\nWDGWV Sitemap Maker.\r\n";
	echo "Version 1.0 -- http://www.wdgwv.nl\r\n\r\n";
}
?>