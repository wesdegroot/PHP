<?php

function client_os()
{
    if (eregi("(win|windows)[ ]*((nt)*[ /]*([0-9]+(.?[0-9]+))*)", getuseragent()))
    {
        if (eregi("(win|windows)[ ](95)", getuseragent()))
        {
         return "Windows 95";
        }
        else if (eregi("(win|windows)[ ](98)", getuseragent()))
        {
         return "Windows 98";
        }
        else if (eregi("(win|windows)[ ](9x)[ ](4.90)", getuseragent()))
        {
         return "Windows ME";
        }
        else if (eregi("(win|windows)[ ](NT)", getuseragent()))
        {
           if (eregi("(win|windows)[ ](NT)[ ](5.1)", getuseragent()))
           {
            return "Windows XP";
           }
           else if (eregi("(win|windows)[ ](NT)[ ](5.0)", getuseragent()))
           {
            return "Windows 2000";
           }
           else if (eregi("(win|windows)[ ](NT)[ ](6.0)", getuseragent())) 
           {
            return "Windows Vista"; 
           }
           else if (eregi("(win|windows)[ ](NT)", getuseragent()))
           {
            return "Windows NT";
           }
        }
        else
        {
         return "Windows";
        }
    }
    else if (stristr(getuseragent(), "linux"))
    {
     if (eregi("(lin|linux)[ ](Suse)", getuseragent()))
     {
      return "SuSe Linux";
     }
     else if (eregi("(lin|linux)[ ](Ubuntu)", getuseragent()))
     {
     return "Ubuntu linux";
     }
     else
     {
     return "Linux";
     }
    }
    else if (isin("unix",getuseragent()))
    {
     return "Unix";
    }
    else if (isin("mac",getuseragent()))
    { 
     if(isin("iphone",getuseragent()))
     {
      return "I-Phone";
     }
     else
     {
      return "Mac OS(X)";
     }
    }
    else if (isin("psp",getuseragent()))
    { 
     return "PlayStation Portable";
    }
    else if (isin("PlayStation",getuseragent()))
    { 
     return "PlayStation 3";
    }
    else if (isin("J2ME",getuseragent()))
    {
    //J2ME/MIDP; Opera Mini
     if ( isin ( "Opera Mini" , getuseragent() ) )
     {
      return "Opra Mini (Java based)";
     }
     else
     {
      return "Java Internet Application";
     }
    }
    else if (isin("Nintendo Wii",getuseragent()))
    {
    return "Nintendo Wii";
    }
    else if (isin("ppc",getuseragent()))
    {
     return "Mac OS(X)";
    }
    else if (isin("HP",getuseragent()))
    {
     return "HPuX";
    }
    else if (isin("sunos",getuseragent())) 
    {
     return "SunOS";
    }
    else
    {
     return "Unknown Operating System";
    }
} 

?>