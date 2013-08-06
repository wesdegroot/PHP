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
                                                                          
                                #,,;                        :,        
                *,. ,,,..::* ;,,,,,;*                 :,..,,,,*       
            ;;;;;;***:::::+;  +:::*+        :,,,,:::+ *;::,,++#       
             +;;;**  +:::*+    :::   :::;;;+;;;;::++*   ;::;          
              ;;;;+   ;:::+    ::*   ***;*** +;;;:+     :::*          
              +;;;+   ;;;:+   *::     **;:+   ;;;;*     ::;           
               ;;;;+  ;;;;*+  ::*     +***+   +;;;;+   *::*           
               **;:#  ;;;;:+  ;;*      ***:+  *;;;:+   ;;*            
               +***+#*;+;;;+ ;;;       +**;+  ;;;;;;  *;;*            
                ***:+**+;;;;+;;;   `**  ****  ;+;;;:+ ;;*             
                ****+*;*;;;;+;;;  `*`*+ ***;+**+;;;;* ;;;             
                 ***;** +;;;+;;   * *   +*****;**;;;*+;;*             
                 ******  *;;;*;   **,    ***:*: +*;;*;;:              
                 +****;  ****;;  ++*`*   *****;  *;;;;;*              
                  ***;*  +***;  +, ++    #***;*  ***;;*               
                  +***    **;*  +;+++;    ****   #***;*               
                   ***    **++  ;++`+`    +**;    *****               
                   ***    +**    #         *+;    +***                
                                           #*      **;                
                                                    +                 
    WDGWV.

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
echo base64_decode("ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAjLCw7ICAgICAgICAgICAgICAgICAgICAgICAgOiwgICAgICAgIA0KICAgICAgICAgICAgICAgICosLiAsLCwuLjo6KiA7LCwsLCw7KiAgICAgICAgICAgICAgICAgOiwuLiwsLCwqICAgICAgIA0KICAgICAgICAgICAgOzs7Ozs7KioqOjo6OjorOyAgKzo6OiorICAgICAgICA6LCwsLDo6OisgKjs6OiwsKysjICAgICAgIA0KICAgICAgICAgICAgICs7OzsqKiAgKzo6OiorICAgIDo6OiAgIDo6Ojs7Oys7Ozs7OjorKyogICA7Ojo7ICAgICAgICAgIA0KICAgICAgICAgICAgICA7Ozs7KyAgIDs6OjorICAgIDo6KiAgICoqKjsqKiogKzs7OzorICAgICA6OjoqICAgICAgICAgIA0KICAgICAgICAgICAgICArOzs7KyAgIDs7OzorICAgKjo6ICAgICAqKjs6KyAgIDs7OzsqICAgICA6OjsgICAgICAgICAgIA0KICAgICAgICAgICAgICAgOzs7OysgIDs7OzsqKyAgOjoqICAgICArKioqKyAgICs7Ozs7KyAgICo6OiogICAgICAgICAgIA0KICAgICAgICAgICAgICAgKio7OiMgIDs7Ozs6KyAgOzsqICAgICAgKioqOisgICo7Ozs6KyAgIDs7KiAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgKyoqKisjKjsrOzs7KyA7OzsgICAgICAgKyoqOysgIDs7Ozs7OyAgKjs7KiAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICoqKjorKiorOzs7Oys7OzsgICBgKiogICoqKiogIDsrOzs7OisgOzsqICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICoqKiorKjsqOzs7Oys7OzsgIGAqYCorICoqKjsrKiorOzs7OyogOzs7ICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICAqKio7KiogKzs7Oys7OyAgICogKiAgICsqKioqKjsqKjs7OyorOzsqICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICAqKioqKiogICo7OzsqOyAgICoqLCAgICAqKio6KjogKyo7Oyo7OzogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICArKioqKjsgICoqKio7OyAgKysqYCogICAqKioqKjsgICo7Ozs7OyogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICAgKioqOyogICsqKio7ICArLCArKyAgICAjKioqOyogICoqKjs7KiAgICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICAgKyoqKiAgICAqKjsqICArOysrKzsgICAgKioqKiAgICMqKio7KiAgICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICAgICoqKiAgICAqKisrICA7KytgK2AgICAgKyoqOyAgICAqKioqKiAgICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICAgICoqKiAgICArKiogICAgIyAgICAgICAgICorOyAgICArKioqICAgICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICMqICAgICAgKio7ICAgICAgICAgICAgICAgIA0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICsgICAgICANCiA="); //WDGWV LOGO
echo "\r\nWDGWV Sitemap Maker.\r\n";
echo "Version 1.0 -- http://www.wdgwv.nl\r\n";

grab_urls($site); //grab the urls.

fwrite($fh, "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\r\n\r\n<!--\r\ncreated with WDGWV Sitemap Generator www.wdgwv.nl\r\n-->\r\n");
// add header.

for($i=0; $i<sizeof($links); $i++)
{
	$links = preg_replace("#&#", "&amp;", $links);
	//make links good for sitemap.

	fwrite($fh, "<url>\r\n<loc>".$links."</loc>\r\n<changefreq>daily</changefreq>\r\n<priority>1.00</priority>\r\n</url>\r\n");
	//add site by site.
}

fwrite($fh, "</urlset>");
// add end of file.

fclose($fh);
//close file

//print_r($links);
//print the websites.

echo "finished see sitemap.xml\r\n";
//send finished message...

?>